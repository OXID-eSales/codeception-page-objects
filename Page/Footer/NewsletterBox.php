<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Footer;

use OxidEsales\Codeception\Page\NewsletterSubscription;
use OxidEsales\Codeception\Module\Translation\Translator;

trait NewsletterBox
{
    public static $newsletterUserEmail = "editval[oxuser__oxusername]";
    public static $newsletterSubscribeButton = "//button[@class='btn btn-primary']";

    /**
     * Opens newsletter page.
     *
     * @param $userEmail
     *
     * @return NewsletterSubscription
     */
    public function subscribeForNewsletter($userEmail)
    {
        $I = $this->user;
        $I->fillField(self::$newsletterUserEmail, $userEmail);
        $I->click(Translator::translate('SUBSCRIBE'), self::$newsletterSubscribeButton);
        return new NewsletterSubscription($I);
    }
}
