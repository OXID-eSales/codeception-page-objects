<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

class UserPasswordReminder extends Page
{
    use AccountMenu;

    public $URL = '/en/forgot-password/';
    public $breadCrumb = '#breadcrumb';
    public $headerTitle = 'h3';
    public string $forgotPasswordUserEmail = '#forgotPasswordUserLoginName';
    public string $resetPasswordButton = '';

    public function seePageOpen(): self
    {
        $this->seeOnBreadCrumb(Translator::translate('FORGOT_PASSWORD'));
        return $this;
    }

    public function resetPassword(string $userEmail): self
    {
        $I = $this->user;
        $I->fillField($this->forgotPasswordUserEmail, $userEmail);
        $I->click(Translator::translate('REQUEST_PASSWORD'));
        return $this;
    }
}
