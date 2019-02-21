<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Header;

use OxidEsales\Codeception\Module\Context;
use OxidEsales\Codeception\Page\Account\ProductCompare;
use OxidEsales\Codeception\Page\Account\UserAccount;
use OxidEsales\Codeception\Page\Account\UserGiftRegistry;
use OxidEsales\Codeception\Page\Account\UserLogin;
use OxidEsales\Codeception\Page\Account\UserPasswordReminder;
use OxidEsales\Codeception\Page\Account\UserWishList;
use OxidEsales\Codeception\Page\UserRegistration;
use OxidEsales\Codeception\Module\Translation\Translator;

trait AccountMenu
{
    public static $accountMenuButton = "//div[@class='menu-dropdowns']/div[3]/button";

    public static $openAccountMenuButton = "//div[@class='menu-dropdowns']/div[3]/ul";

    public static $userRegistrationLink = '#registerLink';

    public static $userLoginName = '#loginEmail';

    public static $userLoginPassword = '#loginPasword';

    public static $userForgotPasswordButton = '//a[@class="forgotPasswordOpener btn btn-tertiary"]';

    public static $userLoginButton = '//div[@id="loginBox"]/button';

    public static $userLogoutButton = '';

    public static $badLoginError = '#errorBadLogin';

    public static $userAccountLink = '//ul[@id="services"]/li[1]/a';

    public static $userAccountCompareListLink = '//ul[@id="services"]/li[2]/a';

    public static $userAccountWishListLink = '//ul[@id="services"]/li[3]/a';

    public static $userAccountGiftRegistryLink = '//ul[@id="services"]/li[4]/a';

    public static $userAccountCompareListText = '//ul[@id="services"]/li[2]';

    public static $userAccountWishListText = '//ul[@id="services"]/li[3]';

    public static $userAccountGiftRegistryText = '//ul[@id="services"]/li[4]';

    /**
     * Opens open-account page.
     *
     * @return UserRegistration
     */
    public function openUserRegistrationPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(self::$userRegistrationLink);
        $userRegistrationPage = new UserRegistration($I);
        $breadCrumb = Translator::translate('PAGE_TITLE_REGISTER');
        $userRegistrationPage->seeOnBreadCrumb($breadCrumb);
        return $userRegistrationPage;
    }

    /**
     * Opens forgot-password page.
     *
     * @return UserPasswordReminder
     */
    public function openUserPasswordReminderPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(self::$userForgotPasswordButton);
        $userPasswordReminderPage = new UserPasswordReminder($I);
        $breadCrumb = Translator::translate('FORGOT_PASSWORD');
        $userPasswordReminderPage->seeOnBreadCrumb($breadCrumb);
        return $userPasswordReminderPage;
    }

    /**
     * @param string $userName
     * @param string $userPassword
     *
     * @return $this
     */
    public function loginUser($userName, $userPassword)
    {
        $I = $this->user;
        // logging in
        $this->openAccountMenu();
        $I->fillField(self::$userLoginName, $userName);
        $I->fillField(self::$userLoginPassword, $userPassword);
        $I->click(self::$userLoginButton);
        Context::setActiveUser($userName);
        return $this;
    }

    /**
     * @return $this
     */
    public function logoutUser()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(Translator::translate('LOGOUT'));
        Context::setActiveUser(null);
        return $this;
    }

    /**
     * Opens my-account page.
     *
     * @return UserAccount
     */
    public function openAccountPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(self::$userAccountLink);
        $I->waitForPageLoad();
        return new UserAccount($I);
    }

    /**
     * Opens my-gift-registry page.
     *
     * @return UserGiftRegistry
     */
    public function openUserGiftRegistryPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(self::$userAccountGiftRegistryLink);
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
    public function openUserWishListPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(self::$userAccountWishListLink);
        $userWishListPage = new UserWishList($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('MY_WISH_LIST');
        $userWishListPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_NOTICELIST'), UserWishList::$headerTitle);
        return $userWishListPage;
    }

    /**
     * Opens my-product-comparison page.
     *
     * @return ProductCompare
     */
    public function openProductComparePage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(self::$userAccountCompareListLink);
        $productComparePage = new ProductCompare($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('PRODUCT_COMPARISON');
        $productComparePage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('COMPARE'), ProductCompare::$headerTitle);
        return $productComparePage;
    }

    /**
     * @return UserLogin
     */
    public function openUserLoginPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(self::$userAccountLink);
        $userLoginPage = new UserLogin($I);
        $breadCrumb = Translator::translate('LOGIN');
        $userLoginPage->seeOnBreadCrumb($breadCrumb);
        return $userLoginPage;
    }

    /**
     * @return $this
     */
    public function openAccountMenu()
    {
        $I = $this->user;
        $I->click(self::$accountMenuButton);
        $I->waitForElement(self::$openAccountMenuButton);
        return $this;
    }

    /**
     * @return $this
     */
    public function closeAccountMenu()
    {
        $I = $this->user;
        $I->click(self::$accountMenuButton);
        $I->waitForElementNotVisible(self::$openAccountMenuButton);
        return $this;
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function checkCompareListItemCount($count)
    {
        $I = $this->user;
        $this->openAccountMenu();
        $cnt = ($count) ? ' '.$count : '';
        $I->see(Translator::translate('MY_PRODUCT_COMPARISON').$cnt, self::$userAccountCompareListText);
        $this->closeAccountMenu();
        return $this;
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function checkWishListItemCount($count)
    {
        $I = $this->user;
        $cnt = ($count) ? ' '.$count : '';
        $I->see(Translator::translate('MY_WISH_LIST').$cnt, self::$userAccountWishListText);
        return $this;
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function checkGiftRegistryItemCount($count)
    {
        $I = $this->user;
        $cnt = ($count) ? ' '.$count : '';
        $I->see(Translator::translate('MY_GIFT_REGISTRY').$cnt, self::$userAccountGiftRegistryText);
        return $this;
    }
}
