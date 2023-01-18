<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class for forgot-password page
 * @package OxidEsales\Codeception\Page\Account
 */
class UserPasswordReminder extends Page
{
    use AccountMenu;

    // include url of current page
    public $URL = '/en/forgot-password/';

    // include bread crumb of current page
    public $breadCrumb = '.breadcrumb';

    public $forgotPasswordUserEmail = '#forgotPasswordUserLoginName';

    public $resetPasswordButton = '';

    /**
     * @param string $userEmail
     *
     * @return $this
     */
    public function resetPassword(string $userEmail)
    {
        $I = $this->user;
        $I->fillField($this->forgotPasswordUserEmail, $userEmail);
        $I->click(Translator::translate('REQUEST_PASSWORD'));
        return $this;
    }
}
