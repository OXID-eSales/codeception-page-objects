<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\PrivateSales;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Account\UserAccount;
use OxidEsales\Codeception\Page\Page;

/**
 * Class Login
 * @package OxidEsales\Codeception\Page\PrivateSales
 */
class Login extends Page
{
    public $URL = '/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

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
        $I->click($this->userAccountLoginButton);
        return $this;
    }

    public function openUserPasswordReminderPage()
    {
        $I = $this->user;
        $I->click($this->forgotPassword);
        return new UserPasswordReminder($I);
    }

    public function confirmAGB()
    {
        $I = $this->user;
        $I->checkOption($this->confirmAGBOption);
        $I->click($this->confirmAGBButton);
        return new UserAccount($I);
    }

    public function openRegistrationPage()
    {
        $I = $this->user;
        $I->click($this->userRegistration);
        return new Registration($I);
    }
}
