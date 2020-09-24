<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\Component\AdminUserForm;
use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class Users
 *
 * @package OxidEsales\Codeception\Admin\User
 */
class MainUserPage extends Page
{
    use UserList;
    use AdminUserForm;

    /**
     * @param AdminUser $adminUser
     * @return $this
     */
    public function seeUserInformation(AdminUser $adminUser): self
    {
        $I = $this->user;
        if ($adminUser->getActive()) {
            $I->seeCheckboxIsChecked($this->userActiveField);
        } else {
            $I->dontSeeCheckboxIsChecked($this->userActiveField);
        }
        $I->seeOptionIsSelected($this->userRightsField, $adminUser->getUserRights());
        $I->seeInField($this->usernameField, $adminUser->getUsername());
        $I->seeInField($this->userCustomerNumberField, $adminUser->getCustomerNumber());
        $I->seeOptionIsSelected($this->userTitleField, $adminUser->getTitle());
        $I->seeInField($this->userFirstNameField, $adminUser->getFirstName());
        $I->seeInField($this->userLastNameField, $adminUser->getFamilyName());
        $I->seeInField($this->userCompanyField, $adminUser->getCompany());
        $I->seeInField($this->userStreetField, $adminUser->getStreet());
        $I->seeInField($this->userStreetNumberField, $adminUser->getStreetNumber());
        $I->seeInField($this->userZipCodeField, $adminUser->getZipCode());
        $I->seeInField($this->userCityField, $adminUser->getCity());
        $I->seeInField($this->userUstidField, $adminUser->getUstid());
        $I->seeInField($this->userAdditonalInformationField, $adminUser->getAdditionalInfo());
        $I->seeOptionIsSelected($this->userCountryIdField, $adminUser->getCountryId());
        $I->seeInField($this->userStateIdField, $adminUser->getStateId());
        $I->seeInField($this->userPhoneField, $adminUser->getPhone());
        $I->seeInField($this->userFaxField, $adminUser->getFax());
        $I->seeInField($this->userBirthDayField, $adminUser->getBirthday());
        $I->seeInField($this->userBirthMonthField, $adminUser->getBirthMonth());
        $I->seeInField($this->userBirthYearField, $adminUser->getBirthYear());
        $this->checkUserPassword($I, $adminUser->getPassword());
        return $this;
    }

    private function checkUserPassword($I, $password)
    {
        $passwordExists = ($password) ? 'Yes' : 'No';
        $I->see($passwordExists, $this->userHasPasswordSelector);
        $I->seeInField($this->userPasswordField, "");
    }

    /**
     * @param AdminUser $adminUser
     * @return $this
     */
    public function editUser(AdminUser $adminUser): self
    {
        $I = $this->user;
        $I->selectEditFrame();

        $this->fillUserMainForm($I, $adminUser);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();

        return $this;
    }
}
