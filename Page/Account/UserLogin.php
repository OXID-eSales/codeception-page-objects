<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class for my-account page
 * @package OxidEsales\Codeception\Page\Account
 */
class UserLogin extends Page
{
    // include url of current page
    public $URL = '/en/my-account/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $userAccountLoginName = '#loginUser';

    public $userAccountLoginPassword = '#loginPwd';

    public $userAccountLoginButton = '#loginButton';

    public $userForgotPasswordLink = '#forgotPasswordLink';

    /**
     * @param string $userName
     * @param string $userPassword
     *
     * @return UserAccount
     */
    public function login(string $userName, string $userPassword)
    {
        $I = $this->user;
        $I->fillField($this->userAccountLoginName, $userName);
        $I->fillField($this->userAccountLoginPassword, $userPassword);
        $I->click($this->userAccountLoginButton);
        $I->dontSee(Translator::translate('LOGIN'));
        return new UserAccount($I);
    }

    /**
     * Opens forgot-password page
     *
     * @return UserPasswordReminder
     */
    public function openUserPasswordReminderPage()
    {
        $I = $this->user;
        $I->click($this->userForgotPasswordLink);
        $userPasswordReminderPage = new UserPasswordReminder($I);
        $breadCrumbName = Translator::translate("YOU_ARE_HERE") . ":" . Translator::translate("FORGOT_PASSWORD");
        $I->see($breadCrumbName, $userPasswordReminderPage->breadCrumb);
        return $userPasswordReminderPage;
    }
}
