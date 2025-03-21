<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\PrivateSales;

use OxidEsales\Codeception\Page\Account\UserAccount;
use OxidEsales\Codeception\Page\Page;

class Login extends Page
{
    public string $URL = '/';

    // include bread crumb of current page
    public string $breadCrumb = '.breadcrumb';

    public $headerTitle = 'h1';

    public $forgotPassword = '#forgotPasswordLink';

    public $userAccountLoginName = '#loginUser';

    public $userAccountLoginPassword = '#loginPwd';

    public $userAccountLoginButton = '#loginButton';

    public $userForgotPasswordLink = '#forgotPasswordLink';

    public $confirmAGBOption = 'ord_agb';

    public $confirmAGBButton = '//form[@id="private-sales-login"]//button';

    public $userRegistration = '#openAccountLink';

    public function login(string $userName, string $userPassword)
    {
        $I = $this->user;
        $I->fillField($this->userAccountLoginName, $userName);
        $I->fillField($this->userAccountLoginPassword, $userPassword);
        $I->clickAndWait($this->userAccountLoginButton);

        return $this;
    }

    public function openUserPasswordReminderPage()
    {
        $I = $this->user;
        $I->clickAndWait($this->forgotPassword);

        return new UserPasswordReminder($I);
    }

    public function confirmAGB()
    {
        $I = $this->user;
        $I->checkOption($this->confirmAGBOption);
        $I->clickAndWait($this->confirmAGBButton);

        return new UserAccount($I);
    }

    public function openRegistrationPage()
    {
        $I = $this->user;
        $I->clickAndWait($this->userRegistration);

        return new Registration($I);
    }
}
