<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

class UserLogin extends Page
{
    public $URL = '/en/my-account/';
    public $breadCrumb = '#breadcrumb';
    public string $userAccountLoginName = '#loginUser';
    public string $userAccountLoginPassword = '#loginPwd';
    public string $userAccountLoginButton = '#loginButton';
    public string $userForgotPasswordLink = '#forgotPasswordLink';

    public function login(string $userName, string $userPassword): UserAccount
    {
        $I = $this->user;
        $I->fillField($this->userAccountLoginName, $userName);
        $I->fillField($this->userAccountLoginPassword, $userPassword);
        $I->click($this->userAccountLoginButton);
        $I->dontSee(Translator::translate('LOGIN'));
        return new UserAccount($I);
    }

    public function loginWithError(string $userName, string $userPassword): self
    {
        $I = $this->user;
        $I->fillField($this->userAccountLoginName, $userName);
        $I->fillField($this->userAccountLoginPassword, $userPassword);
        $I->click($this->userAccountLoginButton);
        $I->see(Translator::translate('LOGIN'));
        return $this;
    }

    public function openUserPasswordReminderPage(): UserPasswordReminder
    {
        $I = $this->user;
        $I->click($this->userForgotPasswordLink);
        $userPasswordReminderPage = new UserPasswordReminder($I);
        $userPasswordReminderPage->seeOnBreadCrumb(
            Translator::translate("YOU_ARE_HERE") . ":" . Translator::translate("FORGOT_PASSWORD")
        );
        return $userPasswordReminderPage;
    }
}
