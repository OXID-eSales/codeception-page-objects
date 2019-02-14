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
    public static $newsletterUserEmail = "#footer_newsletter_oxusername";
    public static $newsletterSubscribeButton = "//section[@class='footer-box footer-box-newsletter']";

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
