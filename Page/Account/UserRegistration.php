<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\UserForm;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for open-account page
 * @package OxidEsales\Codeception\Page\Account
 */
class UserRegistration extends Page
{
    use UserForm, AccountMenu;

    // include url of current page
    public $URL = '/en/open-account';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    //save form button
    public $saveFormButton = '#accUserSaveTop';

    /**
     * @return $this
     */
    public function registerUser()
    {
        $I = $this->user;
        $I->click($this->saveFormButton);
        $I->waitForElement($this->breadCrumb);
        return $this;
    }
}
