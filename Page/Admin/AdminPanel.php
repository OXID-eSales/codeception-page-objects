<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Admin\Component\NavBar;

/**
 * Class AdminPanel
 *
 * @package OxidEsales\Codeception\Page\Admin
 */
class AdminPanel extends AdminPage
{

    use NavBar;

    public $URL = '/admin/';
    public $userAccountLoginName = '#usr';
    public $userAccountLoginButton = '.btn';
    public $userAccountLoginPassword = '#pwd';

    /**
     * @param string $userName
     * @param string $userPassword
     *
     * @return UserAccount
     */
    public function login(string $userName, string $userPassword): AdminPage
    {
        $I = $this->user;
        $I->fillField($this->userAccountLoginName, $userName);
        $I->fillField($this->userAccountLoginPassword, $userPassword);
        $I->click($this->userAccountLoginButton);
        $I->dontSee(Translator::translate('LOGIN'));

        return $this;
    }
}
