<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use Codeception\Actor;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;

trait AdminUserAddressesForm
{
    Public $addressTitleField = 'editval[oxaddress__oxsal]';
    Public $addressTitleSelector = "//input[@name='editval[oxaddress__oxsal]']";
    Public $addressFirstNameField = 'editval[oxaddress__oxfname]';
    Public $addressLastNameField = 'editval[oxaddress__oxlname]';
    Public $addressCompanyField = 'editval[oxaddress__oxcompany]';
    Public $addressStreetField = 'editval[oxaddress__oxstreet]';
    Public $addressStreetNumberField = 'editval[oxaddress__oxstreetnr]';
    Public $addressZipCodeField = 'editval[oxaddress__oxzip]';
    Public $addressCityField = 'editval[oxaddress__oxcity]';
    Public $addressAdditonalInformationField = 'editval[oxaddress__oxaddinfo]';
    Public $addressCountryIdField = 'editval[oxaddress__oxcountryid]';
    Public $addressPhoneField = 'editval[oxaddress__oxfon]';
    Public $addressFaxField = 'editval[oxaddress__oxfax]';

    /**
     * @param Actor     $I
     * @param AdminUserAddresses $adminUserAddresses
     */
    public function fillUserAddressForm(Actor $I, AdminUserAddresses $adminUserAddresses): void
    {
        $fillForm = new FillForm();

        if($adminUserAddresses->getTitle() != NULL){
            $fillForm->chooseFormSelect($I, $this->addressTitleField, $adminUserAddresses->getTitle());
        }

        if($adminUserAddresses->getFirstName() != NULL){
            $fillForm->fillFormInput($I, $this->addressFirstNameField, $adminUserAddresses->getFirstName());
        }

        if($adminUserAddresses->getLastName() != NULL){
            $fillForm->fillFormInput($I, $this->addressLastNameField, $adminUserAddresses->getLastName());
        }

        if($adminUserAddresses->getCompany() != NULL){
            $fillForm->fillFormInput($I, $this->addressCompanyField, $adminUserAddresses->getCompany());
        }

        if($adminUserAddresses->getStreet() != NULL){
            $fillForm->fillFormInput($I, $this->addressStreetField, $adminUserAddresses->getStreet());
        }

        if($adminUserAddresses->getStreetNumber() != NULL){
            $fillForm->fillFormInput($I, $this->addressStreetNumberField, $adminUserAddresses->getStreetNumber());
        }

        if($adminUserAddresses->getZip() != NULL){
            $fillForm->fillFormInput($I, $this->addressZipCodeField, $adminUserAddresses->getZip());
        }

        if($adminUserAddresses->getCity() != NULL){
            $fillForm->fillFormInput($I, $this->addressCityField, $adminUserAddresses->getCity());
        }

        if($adminUserAddresses->getAdditionalInfo() != NULL){
            $fillForm->fillFormInput($I, $this->addressAdditonalInformationField, $adminUserAddresses->getAdditionalInfo());
        }

        if($adminUserAddresses->getCountryId() != NULL){
            $fillForm->chooseFormSelect($I, $this->addressCountryIdField, $adminUserAddresses->getCountryId());
        }

        if($adminUserAddresses->getPhone() != NULL){
            $fillForm->fillFormInput($I, $this->addressPhoneField, $adminUserAddresses->getPhone());
        }

        if($adminUserAddresses->getFax() != NULL){
            $fillForm->fillFormInput($I, $this->addressFaxField, $adminUserAddresses->getFax());
        }
    }
}
