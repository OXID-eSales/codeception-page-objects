<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Step;

use OxidEsales\Codeception\Page\Home;
use OxidEsales\Codeception\Module\Translation\Translator;

class Start extends Step
{
    /**
     * @param $userEmail
     * @param $userName
     * @param $userLastName
     *
     * @return \OxidEsales\Codeception\Page\NewsletterSubscription
     */
    public function registerUserForNewsletter($userEmail, $userName, $userLastName)
    {
        $I = $this->user;
        $homePage = new Home($I);
        $newsletterPage = $homePage->subscribeForNewsletter($userEmail);
        $newsletterPage->enterUserData($userEmail, $userName, $userLastName)->subscribe();
        $I->see(Translator::translate('MESSAGE_THANKYOU_FOR_SUBSCRIBING_NEWSLETTERS'));
        return $newsletterPage;

    }

    /**
     * @param $userName
     * @param $userPassword
     *
     * @return Home
     */
    public function loginOnStartPage($userName, $userPassword)
    {
        $I = $this->user;
        $startPage = $I->openShop();
        // if snapshot exists - skipping login
        if ($I->loadSessionSnapshot('login')) {
            return $startPage;
        }
        $startPage = $startPage->loginUser($userName, $userPassword);
        $I->saveSessionSnapshot('login');
        return $startPage;
    }
}