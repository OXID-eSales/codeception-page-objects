<?php
namespace OxidEsales\Codeception\Page\Account;
use OxidEsales\Codeception\Module\Translator;

trait AccountNavigation
{
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
        /** @var \AcceptanceTester $I */
        $I = $this->user;
        $I->click(Translator::translate('NEWSLETTER_SETTINGS'), self::$newsletterSettingsLink);
        $breadCrumb = Translator::translate('YOU_ARE_HERE').':'.Translator::translate('MY_ACCOUNT').Translator::translate('NEWSLETTER_SETTINGS');
        $I->see($breadCrumb, NewsletterSettings::$breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_NEWSLETTER'), NewsletterSettings::$headerTitle);
        return new NewsletterSettings($I);
    }

    /**
     * Opens my-address page.
     *
     * @return UserAddress
     */
    public function openUserAddressPage()
    {
        /** @var \AcceptanceTester $I */
        $I = $this->user;
        $I->click(Translator::translate('BILLING_SHIPPING_SETTINGS'), self::$addressSettingsLink);
        $breadCrumb = Translator::translate('YOU_ARE_HERE').':'.Translator::translate('MY_ACCOUNT').Translator::translate('BILLING_SHIPPING_SETTINGS');
        $I->see($breadCrumb, UserAddress::$breadCrumb);
        $I->see(Translator::translate('BILLING_SHIPPING_SETTINGS'), UserAddress::$headerTitle);
        return new UserAddress($I);
    }

    /**
     * Opens my-gift-registry page.
     *
     * @return UserGiftRegistry
     */
    public function openGiftRegistryPage()
    {
        /** @var \AcceptanceTester $I */
        $I = $this->user;
        $I->click(Translator::translate('MY_GIFT_REGISTRY'), self::$giftRegistryLink);
        $breadCrumb = Translator::translate('YOU_ARE_HERE').':'.Translator::translate('MY_ACCOUNT').Translator::translate('MY_GIFT_REGISTRY');
        $I->see($breadCrumb, UserGiftRegistry::$breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_WISHLIST'), UserGiftRegistry::$headerTitle);
        return new UserGiftRegistry($I);
    }

    /**
     * Opens my-wish-list page.
     *
     * @return UserWishList
     */
    public function openWishListPage()
    {
        /** @var \AcceptanceTester $I */
        $I = $this->user;
        $I->click(Translator::translate('MY_WISH_LIST'), self::$wishListLink);
        $breadCrumb = Translator::translate('YOU_ARE_HERE').':'.Translator::translate('MY_ACCOUNT').Translator::translate('MY_WISH_LIST');
        $I->see($breadCrumb, UserWishList::$breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_NOTICELIST'), UserWishList::$headerTitle);
        return new UserWishList($I);
    }

}
