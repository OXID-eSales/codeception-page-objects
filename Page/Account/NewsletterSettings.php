<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class for account_newsletter page
 * @package OxidEsales\Codeception\Page\Account
 */
class NewsletterSettings extends Page
{
    // include url of current page
    public $URL = '/index.php?lang=1&cl=account_newsletter';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $headerTitle = 'h1';

    public $newsletterStatusSelect = '//button[@data-id="status"]';

    public $newsletterSubscribeButton = '#newsletterSettingsSave';

    /**
     * Responsible for newsletter subscription
     *
     * @return $this
     */
    public function subscribeNewsletter()
    {
        $I = $this->user;
        $I->click($this->newsletterStatusSelect);
        $I->click(Translator::translate('YES'));
        $I->click($this->newsletterSubscribeButton);
        $I->see(Translator::translate('MESSAGE_NEWSLETTER_SUBSCRIPTION_SUCCESS'));
        return $this;
    }

    /**
     * Responsible for newsletter unsubscription
     *
     * @return $this
     */
    public function unSubscribeNewsletter()
    {
        $I = $this->user;
        $I->click($this->newsletterStatusSelect);
        $I->click(Translator::translate('NO'));
        $I->click($this->newsletterSubscribeButton);
        $I->see(Translator::translate('MESSAGE_NEWSLETTER_SUBSCRIPTION_CANCELED'));
        return $this;
    }

    /**
     * Check if newsletter is subscribed
     *
     * @return $this
     */
    public function seeNewsletterSubscribed()
    {
        $I = $this->user;
        $I->see(Translator::translate('YES'), $this->newsletterStatusSelect);
        return $this;
    }

    /**
     * Check if newsletter is unsubscribed
     *
     * @return $this
     */
    public function seeNewsletterUnSubscribed()
    {
        $I = $this->user;
        $I->see(Translator::translate('NO'), $this->newsletterStatusSelect);
        return $this;
    }
}
