<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Footer;

use OxidEsales\Codeception\Page\Info\NewsletterSubscription;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Trait for newsletter widget in footer
 * @package OxidEsales\Codeception\Page\Component\Footer
 */
trait NewsletterBox
{
    public string $newsletterUserEmail = "#footer_newsletter_oxusername";
    public string $newsletterSubscribeButton = "//section[@class='footer-box footer-box-newsletter']";

    /**
     * Opens newsletter page.
     *
     * @param string $userEmail
     *
     * @return NewsletterSubscription
     */
    public function subscribeForNewsletter(string $userEmail): NewsletterSubscription
    {
        $I = $this->user;
        $I->fillField($this->newsletterUserEmail, $userEmail);
        $I->waitForElementClickable($this->newsletterSubscribeButton);
        $I->click(Translator::translate('SUBSCRIBE'), $this->newsletterSubscribeButton);
        $newsletterSubscriptionPage = new NewsletterSubscription($I);
        $I->waitForElementVisible($newsletterSubscriptionPage->userEmail);
        $I->waitForPageLoad();

        return $newsletterSubscriptionPage;
    }
}
