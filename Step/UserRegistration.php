<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Step;

use OxidEsales\Codeception\Module\Translation\Translator;

class UserRegistration extends Step
{
    public function registerUser($userLoginDataToFill, $userDataToFill, $addressDataToFill)
    {
        $I = $this->user;
        $breadCrumbName = Translator::translate("PAGE_TITLE_REGISTER");
        $registrationPage = new \OxidEsales\Codeception\Page\UserRegistration($I);
        $registrationPage->enterUserLoginData($userLoginDataToFill)
            ->enterUserData($userDataToFill)
            ->enterAddressData($addressDataToFill)
            ->registerUser();

        $registrationPage->seeOnBreadCrumb($breadCrumbName);
        $I->see(Translator::translate('MESSAGE_WELCOME_REGISTERED_USER'));
    }
}