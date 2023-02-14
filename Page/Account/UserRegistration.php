<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Module\Translation\Translator;
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
    public $breadCrumb = '.breadcrumb';

    public $headerTitle = 'h3';

    //save form button
    public $saveFormButton = '#accUserSaveTop';

    public function seePageOpen()
    {
        $I = $this->user;
        $I->see(Translator::translate('OPEN_ACCOUNT'), $this->headerTitle);
        return $this;
    }

    /**
     * @return $this
     */
    public function registerUser()
    {
        $I = $this->user;
        $I->retryClick($this->saveFormButton);
        $I->see(Translator::translate('MESSAGE_WELCOME_REGISTERED_USER'), $this->headerTitle);
        return $this;
    }
}
