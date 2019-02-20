<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Info;

use OxidEsales\Codeception\Page\Page;

/**
 * Class for newsletter page
 * @package OxidEsales\Codeception\Page\Info
 */
class NewsletterSubscription extends Page
{
    // include url of current page
    public $URL = '/en/newsletter/';

    public $userFirstName = '#newsletterFname';

    public $userLastName = '#newsletterLname';

    public $userEmail = '#newsletterUserName';

    public $newsletterSubmitButton = '#newsLetterSubmit';

    public $subscribeCheckbox = '#newsletterSubscribeOn';

    public $unSubscribeCheckbox = '#newsletterSubscribeOff';

    /**
     * Fill fields with user information.
     *
     * @param string $userEmail
     * @param string $userFirstName
     * @param string $userLastName
     *
     * @return $this
     */
    public function enterUserData(string $userEmail, string $userFirstName, string $userLastName)
    {
        $I = $this->user;
        $I->fillField($this->userFirstName, $userFirstName);
        $I->fillField($this->userLastName, $userLastName);
        $I->fillField($this->userEmail, $userEmail);
        return $this;
    }

    /**
     * Submit the newsletter subscription form.
     *
     * @return $this
     */
    public function subscribe()
    {
        $I = $this->user;
        $I->checkOption($this->subscribeCheckbox);
        $I->click($this->newsletterSubmitButton);
        return $this;
    }
}
