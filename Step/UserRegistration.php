<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Step;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class UserRegistration
 * @package OxidEsales\Codeception\Step
 */
class UserRegistration extends Step
{
    /**
     * @param array $userLoginDataToFill
     * @param array $userDataToFill
     * @param array $addressDataToFill
     */
    public function registerUser(array $userLoginDataToFill, array $userDataToFill, array $addressDataToFill)
    {
        $I = $this->user;
        $breadCrumbName = Translator::translate("PAGE_TITLE_REGISTER");
        $registrationPage = new \OxidEsales\Codeception\Page\Account\UserRegistration($I);
        $registrationPage->enterUserLoginData($userLoginDataToFill)
            ->enterUserData($userDataToFill)
            ->enterAddressData($addressDataToFill)
            ->registerUser();

        $registrationPage->seeOnBreadCrumb($breadCrumbName);
        $I->see(Translator::translate('MESSAGE_WELCOME_REGISTERED_USER'));
    }
}
