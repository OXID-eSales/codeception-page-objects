<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Footer;

use OxidEsales\Codeception\Page\Info\NewsletterSubscription;

/**
 * Trait for newsletter widget in footer
 */
trait NewsletterBox
{
    public string $newsletterUserEmail = "#footer_newsletter_oxusername";
    public string $newsletterSubscribeButton = '//form[@class="newsletter-form"]/div/div/button';

    public function subscribeForNewsletter(string $userEmail): NewsletterSubscription
    {
        $I = $this->user;
        $I->fillField($this->newsletterUserEmail, $userEmail);
        $I->waitForElementClickable($this->newsletterSubscribeButton);
        $I->clickAndWait($this->newsletterSubscribeButton);
        $newsletterSubscriptionPage = new NewsletterSubscription($I);
        $I->waitForElementVisible($newsletterSubscriptionPage->userEmail);

        return $newsletterSubscriptionPage;
    }
}
