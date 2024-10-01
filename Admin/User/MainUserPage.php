<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class MainUserPage extends Page
{
    use UserList;

    public string $userActiveField = "//input[@name='editval[oxuser__oxactive]'][@type='checkbox']";
    public string $usernameField = "//input[@name='editval[oxuser__oxusername]']";
    public string $userCustomerNumberField = "//input[@name='editval[oxuser__oxcustnr]']";
    public string $userTitleField = "//select[@name='editval[oxuser__oxsal]']";
    public string $userFirstNameField = "//input[@name='editval[oxuser__oxfname]']";
    public string $userLastNameField = "//input[@name='editval[oxuser__oxlname]']";
    public string $userCompanyField = "//input[@name='editval[oxuser__oxcompany]']";
    public string $userStreetField = "//input[@name='editval[oxuser__oxstreet]']";
    public string $userStreetNumberField = "//input[@name='editval[oxuser__oxstreetnr]']";
    public string $userZipCodeField = "//input[@name='editval[oxuser__oxzip]']";
    public string $userCityField = "//input[@name='editval[oxuser__oxcity]']";
    public string $userUstidField = "//input[@name='editval[oxuser__oxustid]']";
    public string $userAdditionalInformationField = "//input[@name='editval[oxuser__oxaddinfo]']";
    public string $userCountryIdField = "//select[@name='editval[oxuser__oxcountryid]']";
    public string $userStateIdField = "//input[@name='editval[oxuser__oxstateid]']";
    public string $userPhoneField = "//input[@name='editval[oxuser__oxfon]']";
    public string $userFaxField = "//input[@name='editval[oxuser__oxfax]']";
    public string $userBirthDayField = "//input[@name='editval[oxuser__oxbirthdate][day]']";
    public string $userBirthMonthField = "//input[@name='editval[oxuser__oxbirthdate][month]']";
    public string $userBirthYearField = "//input[@name='editval[oxuser__oxbirthdate][year]']";
    public string $userPasswordField = 'newPassword';
    public string $userRightsField = "//select[@name='editval[oxuser__oxrights]']";
    public string $userHasPasswordSelector = '#myedit table tr:nth-child(17) td:nth-child(2)';

    /**
     * @param AdminUser $user
     * @param AdminUserAddresses $userAddress
     * @return $this
     */
    public function editUserInformation(AdminUser $user, AdminUserAddresses $userAddress): self
    {
        $I = $this->user;

        if ($user->getActive()) {
            $I->checkOption($this->userActiveField);
        } else {
            $I->uncheckOption($this->userActiveField);
        }
        $I->fillField($this->usernameField, $user->getUsername());
        $I->fillField($this->userCustomerNumberField, $user->getCustomerNumber());
        $I->selectOption($this->userTitleField, $userAddress->getTitle());
        $I->fillField($this->userFirstNameField, $userAddress->getFirstName());
        $I->fillField($this->userLastNameField, $userAddress->getLastName());
        $I->fillField($this->userCompanyField, $userAddress->getCompany());
        $I->fillField($this->userStreetField, $userAddress->getStreet());
        $I->fillField($this->userStreetNumberField, $userAddress->getStreetNumber());
        $I->fillField($this->userZipCodeField, $userAddress->getZip());
        $I->fillField($this->userCityField, $userAddress->getCity());
        $I->fillField($this->userUstidField, $user->getUstid());
        $I->fillField($this->userAdditionalInformationField, $userAddress->getAdditionalInfo());
        $I->selectOption($this->userCountryIdField, $userAddress->getCountryId());
        $I->fillField($this->userStateIdField, $userAddress->getStateId());
        $I->fillField($this->userPhoneField, $userAddress->getPhone());
        $I->fillField($this->userFaxField, $userAddress->getFax());
        $I->fillField($this->userBirthDayField, $user->getBirthday());
        $I->fillField($this->userBirthMonthField, $user->getBirthMonth());
        $I->fillField($this->userBirthYearField, $user->getBirthYear());
        $I->fillField($this->userPasswordField, $user->getPassword());
        $I->selectOption($this->userRightsField, $user->getUserRights());

        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->waitForDocumentReadyState();

        return $this;
    }

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
        $I->seeInField($this->userAdditionalInformationField, $adminUserAddress->getAdditionalInfo());
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

    public function updatePassword(string $pass): static
    {
        $I = $this->user;
        $I->fillField($this->userPasswordField, $pass);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->waitForDocumentReadyState();

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
        $this->editUserInformation($adminUser, $adminUserAddress);

        return $this;
    }
}
