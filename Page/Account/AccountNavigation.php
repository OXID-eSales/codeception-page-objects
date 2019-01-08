<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

trait AccountNavigation
{
    /**
     * @var AcceptanceTester
     */
    protected $user;

    public static $newsletterSettingsLink = '//nav[@id="account_menu"]';

    public static $addressSettingsLink = '//nav[@id="account_menu"]';

    public static $giftRegistryLink = '//nav[@id="account_menu"]';

    public static $wishListLink = '//nav[@id="account_menu"]';

    /**
     * Opens account_newsletter page
     *
     * @return NewsletterSettings
     */
    public function openNewsletterSettingsPage()
    {
        $I = $this->user;
        $I->waitForElement(self::$newsletterSettingsLink);
        $I->click(Translator::translate('NEWSLETTER_SETTINGS'), self::$newsletterSettingsLink);
        $newsletterSettingsPage = new NewsletterSettings($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('NEWSLETTER_SETTINGS');
        $newsletterSettingsPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_NEWSLETTER'), NewsletterSettings::$headerTitle);
        return $newsletterSettingsPage;
    }

    /**
     * Opens my-address page.
     *
     * @return UserAddress
     */
    public function openUserAddressPage()
    {
        $I = $this->user;
        $I->waitForElement(self::$addressSettingsLink);
        $I->click(Translator::translate('BILLING_SHIPPING_SETTINGS'), self::$addressSettingsLink);
        $userAddressPage = new UserAddress($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('BILLING_SHIPPING_SETTINGS');
        $userAddressPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('BILLING_SHIPPING_SETTINGS'), UserAddress::$headerTitle);
        return $userAddressPage;
    }

    /**
     * Opens my-gift-registry page.
     *
     * @return UserGiftRegistry
     */
    public function openGiftRegistryPage()
    {
        $I = $this->user;
        $I->waitForElement(self::$giftRegistryLink);
        $I->click(Translator::translate('MY_GIFT_REGISTRY'), self::$giftRegistryLink);
        $userGiftRegistryPage = new UserGiftRegistry($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('MY_GIFT_REGISTRY');
        $userGiftRegistryPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_WISHLIST'), UserGiftRegistry::$headerTitle);
        return $userGiftRegistryPage;
    }

    /**
     * Opens my-wish-list page.
     *
     * @return UserWishList
     */
    public function openWishListPage()
    {
        $I = $this->user;
        $I->waitForElement(self::$wishListLink);
        $I->click(Translator::translate('MY_WISH_LIST'), self::$wishListLink);
        $userWishListPage = new UserWishList($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('MY_WISH_LIST');
        $userWishListPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_NOTICELIST'), UserWishList::$headerTitle);
        return $userWishListPage;
    }

}
