<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Header;

use OxidEsales\Codeception\Module\Context;
use OxidEsales\Codeception\Page\Account\ProductCompare;
use OxidEsales\Codeception\Page\Account\UserAccount;
use OxidEsales\Codeception\Page\Account\UserGiftRegistry;
use OxidEsales\Codeception\Page\Account\UserLogin;
use OxidEsales\Codeception\Page\Account\UserPasswordReminder;
use OxidEsales\Codeception\Page\Account\UserWishList;
use OxidEsales\Codeception\Page\Account\UserRegistration;
use OxidEsales\Codeception\Module\Translation\Translator;

trait AccountMenu
{
    public string $accountMenuButton = "//div[contains(@class,'service-menu')]/button";
    public string $openAccountMenuButton = "//div[contains(@class,'service-menu')]/ul";
    public string $userRegistrationLink = '#registerLink';
    public string $userLoginName = '#loginEmail';
    public string $userLoginPassword = '#loginPasword';
    public string $userForgotPasswordButton = '//a[@class="forgotPasswordOpener btn btn-default"]';
    public string $userLoginButton = '//div[@id="loginBox"]/button';
    public string $userLogoutButton = '';
    public string $badLoginError = '#errorBadLogin';
    public string $userAccount = '//ul[@id="services"]';
    public string $userAccountLink = '//ul[@id="services"]/li[1]/a';
    public string $userAccountCompareListLink = '//ul[@id="services"]/li[2]/a';
    public string $userAccountWishListLink = '//ul[@id="services"]/li[3]/a';
    public string $userAccountGiftRegistryLink = '//ul[@id="services"]/li[4]/a';
    public string $userAccountCompareListText = '//ul[@id="services"]/li[2]';
    public string $userAccountWishListText = '//ul[@id="services"]/li[3]';
    public string $userAccountGiftRegistryText = '//ul[@id="services"]/li[4]';

    public function openUserRegistrationPage(): UserRegistration
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userRegistrationLink);
        $I->click($this->userRegistrationLink);
        $userRegistrationPage = new UserRegistration($I);
        $userRegistrationPage->seePageOpen();
        return $userRegistrationPage;
    }

    public function openUserPasswordReminderPage(): UserPasswordReminder
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userForgotPasswordButton);
        $I->click($this->userForgotPasswordButton);
        $userPasswordReminderPage = new UserPasswordReminder($I);
        $userPasswordReminderPage->seePageOpen();
        return $userPasswordReminderPage;
    }

    public function loginUser(string $userName, string $userPassword): self
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userLoginName);
        $I->fillField($this->userLoginName, $userName);
        $I->fillField($this->userLoginPassword, $userPassword);
        $I->click($this->userLoginButton);
        $I->waitForPageLoad();
        Context::setActiveUser($userName);
        return $this;
    }

    public function logoutUser(): self
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForText(Translator::translate('LOGOUT'));
        $I->click(Translator::translate('LOGOUT'));
        $I->waitForPageLoad();
        Context::resetActiveUser();
        return $this;
    }

    public function seeUserLoggedIn(): self
    {
        $this->user->dontSee(Translator::translate('LOGIN'));
        return $this;
    }

    public function seeUserLoggedOut(): self
    {
        $this->user->see(Translator::translate('LOGIN'));
        return $this;
    }

    public function openAccountPage(): UserAccount
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountLink);
        $I->click($this->userAccountLink);
        $I->waitForPageLoad();
        return new UserAccount($I);
    }

    public function openUserGiftRegistryPage(): UserGiftRegistry
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountGiftRegistryLink);
        $I->click($this->userAccountGiftRegistryLink);
        $I->waitForPageLoad();
        $userGiftRegistryPage = new UserGiftRegistry($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT') . Translator::translate('MY_GIFT_REGISTRY');
        $userGiftRegistryPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('PAGE_TITLE_ACCOUNT_WISHLIST'), $userGiftRegistryPage->headerTitle);
        return $userGiftRegistryPage;
    }

    public function openUserWishListPage(): UserWishList
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountWishListLink);
        $I->click($this->userAccountWishListLink);
        $I->waitForPageLoad();
        $userWishListPage = new UserWishList($I);
        $userWishListPage->seePageOpen();
        return $userWishListPage;
    }

    public function openProductComparePage(): ProductCompare
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountCompareListLink);
        $I->click($this->userAccountCompareListLink);
        $I->waitForPageLoad();
        $productComparePage = new ProductCompare($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT') . Translator::translate('PRODUCT_COMPARISON');
        $productComparePage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('COMPARE'), $productComparePage->headerTitle);
        return $productComparePage;
    }

    public function openUserLoginPage(): UserLogin
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userAccountLink);
        $I->click($this->userAccountLink);
        $I->waitForPageLoad();
        $userLoginPage = new UserLogin($I);
        $breadCrumb = Translator::translate('LOGIN');
        $userLoginPage->seeOnBreadCrumb($breadCrumb);
        return $userLoginPage;
    }

    public function openAccountMenu(): self
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $I->waitForElementVisible($this->accountMenuButton);
        $I->click($this->accountMenuButton);
        $I->waitForElementClickable($this->openAccountMenuButton);
        return $this;
    }

    public function closeAccountMenu(): self
    {
        $I = $this->user;
        $I->waitForElementVisible($this->accountMenuButton);
        $I->click($this->accountMenuButton);
        $I->waitForElementNotVisible($this->openAccountMenuButton);
        return $this;
    }

    public function checkCompareListItemCount(int $count): self
    {
        $I = $this->user;
        $this->openAccountMenu();
        $cnt = ($count) ? ' ' . $count : '';
        $I->waitForText(Translator::translate('MY_PRODUCT_COMPARISON'));
        $I->see(Translator::translate('MY_PRODUCT_COMPARISON') . $cnt, $this->userAccountCompareListText);
        $this->closeAccountMenu();
        return $this;
    }

    public function checkWishListItemCount(int $count): self
    {
        $I = $this->user;
        $this->openAccountMenu();
        $cnt = ($count) ? ' ' . $count : '';
        $I->waitForText(Translator::translate('MY_WISH_LIST'));
        $I->see(Translator::translate('MY_WISH_LIST') . $cnt, $this->userAccountWishListText);
        $this->closeAccountMenu();
        return $this;
    }

    public function checkGiftRegistryItemCount(int $count): self
    {
        $I = $this->user;
        $cnt = ($count) ? ' ' . $count : '';
        $I->waitForText(Translator::translate('MY_GIFT_REGISTRY'));
        $I->see(Translator::translate('MY_GIFT_REGISTRY') . $cnt, $this->userAccountGiftRegistryText);
        return $this;
    }
}
