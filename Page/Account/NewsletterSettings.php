<?php
namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translator;

class NewsletterSettings extends Page
{
    // include url of current page
    public static $URL = '/index.php?lang=1&cl=account_newsletter';

    // include bread crumb of current page
    public static $breadCrumb = '#breadcrumb';

    public static $headerTitle = 'h1';

    public static $newsletterStatusSelect = '//select[@id="status"]';

    public static $newsletterSubscribeButton = '#newsletterSettingsSave';

    /**
     * @return $this
     */
    public function subscribeNewsletter()
    {
        $I = $this->user;
        $I->selectOption(self::$newsletterStatusSelect, Translator::translate('YES'));
        $I->click(self::$newsletterSubscribeButton);
        $I->see(Translator::translate('MESSAGE_NEWSLETTER_SUBSCRIPTION_SUCCESS'));
        return $this;
    }

    /**
     * @return $this
     */
    public function unSubscribeNewsletter()
    {
        $I = $this->user;
        $I->selectOption(self::$newsletterStatusSelect, Translator::translate('NO'));
        $I->click(self::$newsletterSubscribeButton);
        $I->see(Translator::translate('MESSAGE_NEWSLETTER_SUBSCRIPTION_CANCELED'));
        return $this;
    }

    /**
     * Check if newsletter is subscribed
     *
     * TODO: should it be here?
     *
     * @return $this
     */
    public function seeNewsletterSubscribed()
    {
        $I = $this->user;
        $I->see(Translator::translate('YES'), self::$newsletterStatusSelect);
        return $this;
    }

    /**
     * Check if newsletter is subscribed
     *
     * TODO: should it be here?
     *
     * @return $this
     */
    public function seeNewsletterUnSubscribed()
    {
        $I = $this->user;
        $I->see(Translator::translate('NO'), self::$newsletterStatusSelect);
        return $this;
    }

}
