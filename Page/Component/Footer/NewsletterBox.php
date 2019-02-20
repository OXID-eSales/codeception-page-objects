<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Component\Footer;

use OxidEsales\Codeception\Page\Info\NewsletterSubscription;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Trait for newsletter widget in footer
 * @package OxidEsales\Codeception\Page\Component\Footer
 */
trait NewsletterBox
{
    public $newsletterUserEmail = "#footer_newsletter_oxusername";
    public $newsletterSubscribeButton = "//section[@class='footer-box footer-box-newsletter']";

    /**
     * Opens newsletter page.
     *
     * @param string $userEmail
     *
     * @return NewsletterSubscription
     */
    public function subscribeForNewsletter(string $userEmail)
    {
        $I = $this->user;
        $I->fillField($this->newsletterUserEmail, $userEmail);
        $I->click(Translator::translate('SUBSCRIBE'), $this->newsletterSubscribeButton);
        return new NewsletterSubscription($I);
    }
}
