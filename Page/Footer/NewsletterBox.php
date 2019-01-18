<?php
namespace OxidEsales\Codeception\Page\Footer;

use OxidEsales\Codeception\Page\NewsletterSubscription;
use OxidEsales\Codeception\Module\Translator;

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
        /** @var \AcceptanceTester $I */
        $I = $this->user;
        $I->fillField(self::$newsletterUserEmail, $userEmail);
        $I->click(Translator::translate('SUBSCRIBE'));
        return new NewsletterSubscription($I);
    }
}
