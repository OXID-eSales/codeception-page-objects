<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account\Component;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Account\NewsletterSettings;
use OxidEsales\Codeception\Page\Account\UserAddress;
use OxidEsales\Codeception\Page\Account\UserGiftRegistry;
use OxidEsales\Codeception\Page\Account\UserListmania;
use OxidEsales\Codeception\Page\Account\UserWishList;

/**
 * Trait for account page navigation
 * @package OxidEsales\Codeception\Page\Account\Component
 */
trait AccountNavigation
{
    public $newsletterSettingsLink = '//nav[@id="account_menu"]';

    public $addressSettingsLink = '//nav[@id="account_menu"]';

    public $giftRegistryLink = '//nav[@id="account_menu"]';

    public $wishListLink = '//nav[@id="account_menu"]';

    public $listmaniaLink = '//nav[@id="account_menu"]';

    /**
     * Opens account_newsletter page
     *
     * @return NewsletterSettings
     */
    public function openNewsletterSettingsPage()
    {
        $I = $this->user;
        $I->waitForElement($this->newsletterSettingsLink);
        $I->click(Translator::translate('NEWSLETTER_SETTINGS'), $this->newsletterSettingsLink);
        $newsletterSettingsPage = new NewsletterSettings($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('NEWSLETTER_SETTINGS');
        $newsletterSettingsPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_NEWSLETTER'), $newsletterSettingsPage->headerTitle);
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
        $I->waitForElement($this->addressSettingsLink);
        $I->click(Translator::translate('BILLING_SHIPPING_SETTINGS'), $this->addressSettingsLink);
        $userAddressPage = new UserAddress($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('BILLING_SHIPPING_SETTINGS');
        $userAddressPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('BILLING_SHIPPING_SETTINGS'), $userAddressPage->headerTitle);
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
        $I->waitForElement($this->giftRegistryLink);
        $I->click(Translator::translate('MY_GIFT_REGISTRY'), $this->giftRegistryLink);
        $userGiftRegistryPage = new UserGiftRegistry($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('MY_GIFT_REGISTRY');
        $userGiftRegistryPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_WISHLIST'), $userGiftRegistryPage->headerTitle);
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
        $I->waitForElement($this->wishListLink);
        $I->click(Translator::translate('MY_WISH_LIST'), $this->wishListLink);
        $userWishListPage = new UserWishList($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('MY_WISH_LIST');
        $userWishListPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_NOTICELIST'), $userWishListPage->headerTitle);
        return $userWishListPage;
    }

    /**
     * Opens my-listmania-list page.
     *
     * @return UserListmania
     */
    public function openListmaniaPage()
    {
        $I = $this->user;
        $I->waitForElement($this->listmaniaLink);
        $I->click(Translator::translate('MY_LISTMANIA'), $this->listmaniaLink);
        $I->waitForPageLoad();
        $userListmania = new UserListmania($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('PAGE_TITLE_ACCOUNT_RECOMMLIST');
        $userListmania->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_RECOMMLIST'), $userListmania->headerTitle);
        return $userListmania;
    }
}
