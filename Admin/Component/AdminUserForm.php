<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use Codeception\Actor;
use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;

trait AdminUserForm
{
    Public $userActiveField = "//input[@name='editval[oxuser__oxactive]'][@type='checkbox']";
    Public $usernameField = 'editval[oxuser__oxusername]';
    Public $userCustomerNumberField = 'editval[oxuser__oxcustnr]';
    Public $userTitleField = 'editval[oxuser__oxsal]';
    Public $userFirstNameField = 'editval[oxuser__oxfname]';
    Public $userLastNameField = 'editval[oxuser__oxlname]';
    Public $userCompanyField = 'editval[oxuser__oxcompany]';
    Public $userStreetField = 'editval[oxuser__oxstreet]';
    Public $userStreetNumberField = 'editval[oxuser__oxstreetnr]';
    Public $userZipCodeField = 'editval[oxuser__oxzip]';
    Public $userCityField = 'editval[oxuser__oxcity]';
    Public $userUstidField = 'editval[oxuser__oxustid]';
    Public $userAdditonalInformationField = 'editval[oxuser__oxaddinfo]';
    Public $userCountryIdField = 'editval[oxuser__oxcountryid]';
    Public $userStateIdField = 'editval[oxuser__oxstateid]';
    Public $userPhoneField = 'editval[oxuser__oxfon]';
    Public $userFaxField = 'editval[oxuser__oxfax]';
    Public $userBirthDayField = 'editval[oxuser__oxbirthdate][day]';
    Public $userBirthMonthField = 'editval[oxuser__oxbirthdate][month]';
    Public $userBirthYearField = 'editval[oxuser__oxbirthdate][year]';
    Public $userPasswordField = 'newPassword';
    Public $userRightsField = 'editval[oxuser__oxrights]';
    public $userHasPasswordSelector = '#myedit table tr:nth-child(17) td:nth-child(2)';

    /**
     * @param Actor $I
     * @param AdminUser $adminUser
     * @param AdminUserAddresses $adminUserAddress
     */
    public function fillUserMainForm(Actor $I, AdminUser $adminUser, AdminUserAddresses $adminUserAddress)
    {
        $fillForm = new FillForm();

        $fillForm->chooseFormCheckbox($I, $this->userActiveField, $adminUser->getActive());

        if($adminUser->getUsername() != NULL){
            $fillForm->fillFormInput($I, $this->usernameField, $adminUser->getUsername());
        }

        if($adminUser->getCustomerNumber() != NULL){
            $fillForm->fillFormInput($I, $this->userCustomerNumberField, $adminUser->getCustomerNumber());
        }

        if($adminUserAddress->getTitle() != NULL){
            $fillForm->chooseFormSelect($I, $this->userTitleField, $adminUserAddress->getTitle());
        }

        if($adminUserAddress->getFirstName() != NULL){
            $fillForm->fillFormInput($I, $this->userFirstNameField, $adminUserAddress->getFirstName());
        }

        if($adminUserAddress->getLastName() != NULL){
            $fillForm->fillFormInput($I, $this->userLastNameField, $adminUserAddress->getLastName());
        }

        if($adminUserAddress->getCompany() != NULL){
            $fillForm->fillFormInput($I, $this->userCompanyField, $adminUserAddress->getCompany());
        }

        if($adminUserAddress->getStreet() != NULL){
            $fillForm->fillFormInput($I, $this->userStreetField, $adminUserAddress->getStreet());
        }

        if($adminUserAddress->getStreetNumber() != NULL){
            $fillForm->fillFormInput($I, $this->userStreetNumberField, $adminUserAddress->getStreetNumber());
        }

        if($adminUserAddress->getZip() != NULL){
            $fillForm->fillFormInput($I, $this->userZipCodeField, $adminUserAddress->getZip());
        }

        if($adminUserAddress->getCity() != NULL){
            $fillForm->fillFormInput($I, $this->userCityField, $adminUserAddress->getCity());
        }

        if($adminUser->getUstid() != NULL){
            $fillForm->fillFormInput($I, $this->userUstidField, $adminUser->getUstid());
        }

        if($adminUserAddress->getAdditionalInfo() != NULL){
            $fillForm->fillFormInput($I, $this->userAdditonalInformationField, $adminUserAddress->getAdditionalInfo());
        }

        if($adminUserAddress->getCountryId() != NULL){
            $fillForm->chooseFormSelect($I, $this->userCountryIdField, $adminUserAddress->getCountryId());
        }

        if($adminUserAddress->getStateId() != NULL){
            $fillForm->fillFormInput($I, $this->userStateIdField, $adminUserAddress->getStateId());
        }

        if($adminUserAddress->getPhone() != NULL){
            $fillForm->fillFormInput($I, $this->userPhoneField, $adminUserAddress->getPhone());
        }

        if($adminUserAddress->getFax() != NULL){
            $fillForm->fillFormInput($I, $this->userFaxField, $adminUserAddress->getFax());
        }

        if($adminUser->getBirthday() != NULL){
            $fillForm->fillFormInput($I, $this->userBirthDayField, $adminUser->getBirthday());
        }

        if($adminUser->getBirthday() != NULL){
            $fillForm->fillFormInput($I, $this->userBirthMonthField, $adminUser->getBirthMonth());
        }

        if($adminUser->getBirthYear() != NULL){
            $fillForm->fillFormInput($I, $this->userBirthYearField, $adminUser->getBirthYear());
        }

        if($adminUser->getPassword() != NULL){
            $fillForm->fillFormInput($I, $this->userPasswordField, $adminUser->getPassword());
        }

        if($adminUser->getUserRights() != NULL){
            $fillForm->chooseFormSelect($I, $this->userRightsField, $adminUser->getUserRights());
        }
    }
}
