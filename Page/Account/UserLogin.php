<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

class UserLogin extends Page
{
    // include url of current page
    public static $URL = '/en/my-account/';

    // include bread crumb of current page
    public static $breadCrumb = '#breadcrumb';

    public static $userAccountLoginName = '#loginUser';

    public static $userAccountLoginPassword = '#loginPwd';

    public static $userAccountLoginButton = '#loginButton';

    public static $userForgotPasswordLink = '#forgotPasswordLink';

    /**
     * @param $userName
     * @param $userPassword
     *
     * @return UserAccount
     */
    public function login($userName, $userPassword)
    {
        $I = $this->user;
        $I->fillField(self::$userAccountLoginName, $userName);
        $I->fillField(self::$userAccountLoginPassword, $userPassword);
        $I->click(self::$userAccountLoginButton);
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
        $I->click(self::$userForgotPasswordLink);
        $breadCrumbName = Translator::translate("YOU_ARE_HERE") . ":" . Translator::translate("FORGOT_PASSWORD");
        $I->see($breadCrumbName, UserPasswordReminder::$breadCrumb);
        return new UserPasswordReminder($I);
    }

}
