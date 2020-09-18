<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use Codeception\Actor;
use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Module\Translation\Translator;

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
    public $newUserButton  = '#btn.new';

    /**
     * @param Actor     $I
     * @param AdminUser $adminUser
     */
    private function fillUserMainForm(Actor $I, AdminUser $adminUser): void
    {
        $fillForm = new FillForm();

        $fillForm->chooseFormCheckbox($I, $this->userActiveField, $adminUser->getActive());

        if($adminUser->getUsername() != NULL){
            $fillForm->fillFormInput($I, $this->usernameField, $adminUser->getUsername());
        }

        if($adminUser->getCustomerNumber() != NULL){
            $fillForm->fillFormInput($I, $this->userCustomerNumberField, $adminUser->getCustomerNumber());
        }

        if($adminUser->getTitle() != NULL){
            $fillForm->chooseFormSelect($I, $this->userTitleField, $adminUser->getTitle());
        }

        if($adminUser->getFirstName() != NULL){
            $fillForm->fillFormInput($I, $this->userFirstNameField, $adminUser->getFirstName());
        }

        if($adminUser->getFamilyName() != NULL){
            $fillForm->fillFormInput($I, $this->userLastNameField, $adminUser->getFamilyName());
        }

        if($adminUser->getCompany() != NULL){
            $fillForm->fillFormInput($I, $this->userCompanyField, $adminUser->getCompany());
        }

        if($adminUser->getStreet() != NULL){
            $fillForm->fillFormInput($I, $this->userStreetField, $adminUser->getStreet());
        }

        if($adminUser->getStreetNumber() != NULL){
            $fillForm->fillFormInput($I, $this->userStreetNumberField, $adminUser->getStreetNumber());
        }

        if($adminUser->getZipCode() != NULL){
            $fillForm->fillFormInput($I, $this->userZipCodeField, $adminUser->getZipCode());
        }

        if($adminUser->getCity() != NULL){
            $fillForm->fillFormInput($I, $this->userCityField, $adminUser->getCity());
        }

        if($adminUser->getUstid() != NULL){
            $fillForm->fillFormInput($I, $this->userUstidField, $adminUser->getUstid());
        }

        if($adminUser->getAdditionalInfo() != NULL){
            $fillForm->fillFormInput($I, $this->userAdditonalInformationField, $adminUser->getAdditionalInfo());
        }

        if($adminUser->getCountryId() != NULL){
            $fillForm->chooseFormSelect($I, $this->userCountryIdField, $adminUser->getCountryId());
        }

        if($adminUser->getStateId() != NULL){
            $fillForm->fillFormInput($I, $this->userStateIdField, $adminUser->getStateId());
        }

        if($adminUser->getPhone() != NULL){
            $fillForm->fillFormInput($I, $this->userPhoneField, $adminUser->getPhone());
        }

        if($adminUser->getFax() != NULL){
            $fillForm->fillFormInput($I, $this->userFaxField, $adminUser->getFax());
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
