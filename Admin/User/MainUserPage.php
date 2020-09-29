<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\Component\AdminUserForm;
use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;
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
     * @param AdminUserAddresses $adminUserAddress
     * @return $this
     */
    public function seeUserInformation(AdminUser $adminUser, AdminUserAddresses $adminUserAddress): self
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
        $I->seeOptionIsSelected($this->userTitleField, $adminUserAddress->getTitle());
        $I->seeInField($this->userFirstNameField, $adminUserAddress->getFirstName());
        $I->seeInField($this->userLastNameField, $adminUserAddress->getLastName());
        $I->seeInField($this->userCompanyField, $adminUserAddress->getCompany());
        $I->seeInField($this->userStreetField, $adminUserAddress->getStreet());
        $I->seeInField($this->userStreetNumberField, $adminUserAddress->getStreetNumber());
        $I->seeInField($this->userZipCodeField, $adminUserAddress->getZip());
        $I->seeInField($this->userCityField, $adminUserAddress->getCity());
        $I->seeInField($this->userUstidField, $adminUser->getUstid());
        $I->seeInField($this->userAdditonalInformationField, $adminUserAddress->getAdditionalInfo());
        $I->seeOptionIsSelected($this->userCountryIdField, $adminUserAddress->getCountryId());
        $I->seeInField($this->userStateIdField, $adminUserAddress->getStateId());
        $I->seeInField($this->userPhoneField, $adminUserAddress->getPhone());
        $I->seeInField($this->userFaxField, $adminUserAddress->getFax());
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
    public function editUser(AdminUser $adminUser, AdminUserAddresses $adminUserAddress): self
    {
        $I = $this->user;
        $I->selectEditFrame();

        $this->fillUserMainForm($I, $adminUser, $adminUserAddress);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();

        return $this;
    }
}
