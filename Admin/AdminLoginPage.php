<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class AdminLoginPage
 *
 * @package OxidEsales\Codeception\Admin
 */
class AdminLoginPage extends AdminPanel
{
    public $URL = '/admin/';

    public $userAccountLoginName = '#usr';
    public $userAccountLoginPassword = '#pwd';
    public $userAccountLoginButton = '.btn';

    /**
     * @param string $userName
     * @param string $userPassword
     *
     * @return AdminPanel
     */
    public function login(string $userName, string $userPassword): AdminPanel
    {
        $I = $this->user;
        $I->fillField($this->userAccountLoginName, $userName);
        $I->fillField($this->userAccountLoginPassword, $userPassword);
        $I->click($this->userAccountLoginButton);

        $adminPanel = new AdminPanel($I);
        $I->selectBaseFrame();
        $I->see(Translator::translate('HOME_DESC'));

        return $adminPanel;
    }
}
