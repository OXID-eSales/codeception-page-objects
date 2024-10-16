<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

class AdminLoginPage extends AdminPanel
{
    public string $URL = '/admin/';

    public $userAccountLoginName = '#usr';
    public $userAccountLoginPassword = '#pwd';
    public $userAccountLoginButton = '.btn';

    public function login(string $userName, string $userPassword): AdminPanel
    {
        $I = $this->user;
        $I->fillField($this->userAccountLoginName, $userName);
        $I->fillField($this->userAccountLoginPassword, $userPassword);
        $I->click($this->userAccountLoginButton);

        $adminPanel = new AdminPanel($I);
        $I->waitForElement($adminPanel->adminNavigation);
        $I->selectBaseFrame();
        $I->waitForText(Translator::translate('NAVIGATION_HOME'));
        $I->see(Translator::translate('HOME_DESC'));

        return $adminPanel;
    }

    public function seeLoginForm(): static
    {
        $I = $this->user;
        $I->seeElement($this->userAccountLoginName);
        $I->seeElement($this->userAccountLoginPassword);
        $I->seeElement($this->userAccountLoginButton);

        return $this;
    }
}
