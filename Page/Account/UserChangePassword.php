<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use Facebook\WebDriver\WebDriverKeys;
use OxidEsales\Codeception\Page\Account\Component\AccountNavigation;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;

class UserChangePassword extends Page
{
    use AccountMenu;
    use AccountNavigation;

    // include url of current page
    public string $URL = '/en/my-password/';

    // include bread crumb of current page
    public string $breadCrumb = '.breadcrumb';

    public $headerTitle = 'h1';

    public $userOldPassword = '#passwordOld';

    public $userNewPassword = '#passwordNew';

    public $userConfirmNewPassword = '#passwordNewConfirm';

    public $userChangePasswordButton = '#savePass';

    public $errorMessage = '//div[@class="alert alert-danger"]';

    public function fillPasswordFields(string $oldPassword, string $newPassword, string $confirmPassword)
    {
        $I = $this->user;
        $I->pressKey($this->userOldPassword, ['ctrl', 'a'], WebDriverKeys::DELETE);
        $I->pressKey($this->userOldPassword, $oldPassword);
        $I->pressKey($this->userNewPassword, ['ctrl', 'a'], WebDriverKeys::DELETE);
        $I->pressKey($this->userNewPassword, $newPassword);
        $I->pressKey($this->userConfirmNewPassword, ['ctrl', 'a'], WebDriverKeys::DELETE);
        $I->pressKey($this->userConfirmNewPassword, $confirmPassword);
        $I->clickAndWait($this->userChangePasswordButton);

        return $this;
    }

    public function changePassword(string $oldPassword, string $newPassword, string $confirmPassword)
    {
        $I = $this->user;
        $this->fillPasswordFields($oldPassword, $newPassword, $confirmPassword);
        $I->waitForPageLoad();

        return $this;
    }
}
