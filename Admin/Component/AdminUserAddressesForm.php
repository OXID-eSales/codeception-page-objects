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
use OxidEsales\Codeception\Module\Translation\Translator;

class AdminUserAddressesForm
{
    Public $titleField = 'editval[oxaddress__oxsal]';
    Public $firstNameField = 'editval[oxaddress__oxfname]';
    Public $lastNameField = 'editval[oxaddress__oxlname]';
    Public $companyField = 'editval[oxaddress__oxcompany]';
    Public $streetField = 'editval[oxaddress__oxstreet]';
    Public $streetNumberField = 'editval[oxaddress__oxstreetnr]';
    Public $zipCodeField = 'editval[oxaddress__oxzip]';
    Public $cityField = 'editval[oxaddress__oxcity]';
    Public $additonalInformationField = 'editval[oxaddress__oxaddinfo]';
    Public $companyIdField = 'editval[oxaddress__oxcountryid]';
    Public $phoneField = 'editval[oxaddress__oxfon]';
    Public $faxField = 'editval[oxaddress__oxfax]';
    public $newAddressButton = '#btn.newaddress';

    /**
     * @param Actor     $I
     * @param AdminUser $adminUserAddresses
     */
    public function fillForm(Actor $I, AdminUserAddresses $adminUserAddresses): void
    {
        if($adminUserAddresses->getTitle() != NULL){
            $this->fillTitle($I, $adminUserAddresses->getTitle());
        }

        if($adminUserAddresses->getFirstName() != NULL){
            $this->fillFirstName($I, $adminUserAddresses->getFirstName());
        }

        if($adminUserAddresses->getLastName() != NULL){
            $this->fillLastName($I, $adminUserAddresses->getLastName());
        }

        if($adminUserAddresses->getCompany() != NULL){
            $this->fillCompany($I, $adminUserAddresses->getCompany());
        }

        if($adminUserAddresses->getStreet() != NULL){
            $this->fillStreet($I, $adminUserAddresses->getStreet());
        }

        if($adminUserAddresses->getStreetNumber() != NULL){
            $this->fillStreetNumber($I, $adminUserAddresses->getStreetNumber());
        }

        if($adminUserAddresses->getZip() != NULL){
            $this->fillZipCode($I, $adminUserAddresses->getZip());
        }

        if($adminUserAddresses->getCity() != NULL){
            $this->fillCity($I, $adminUserAddresses->getCity());
        }

        if($adminUserAddresses->getAdditionalInfo() != NULL){
            $this->fillAdditionalInfo($I, $adminUserAddresses->getAdditionalInfo());
        }

        if($adminUserAddresses->getCountryId() != NULL){
            $this->fillCountryId($I, $adminUserAddresses->getCountryId());
        }

        if($adminUserAddresses->getPhone() != NULL){
            $this->fillPhone($I, $adminUserAddresses->getPhone());
        }

        if($adminUserAddresses->getFax() != NULL){
            $this->fillFax($I, $adminUserAddresses->getFax());
        }
    }

    /**
     * @param Actor  $I
     * @param string $title
     *
     * @return $this
     */
    private function fillTitle(Actor $I, string $title): self
    {
        $I->selectOption($this->titleField, $title);
        $I->seeOptionIsSelected($this->titleField, $title);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $firstName
     *
     * @return $this
     */
    private function fillFirstName(Actor $I, string $firstName): self
    {
        $I->fillField($this->firstNameField, $firstName);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $familyName
     *
     * @return $this
     */
    private function fillLastName(Actor $I, string $lastName): self
    {
        $I->fillField($this->lastNameField, $lastName);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $company
     *
     * @return $this
     */
    private function fillCompany(Actor $I, string $company): self
    {
        $I->fillField($this->companyField, $company);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $street
     *
     * @return $this
     */
    private function fillStreet(Actor $I, string $street): self
    {
        $I->fillField($this->streetField, $street);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $streetNumber
     *
     * @return $this
     */
    private function fillStreetNumber(Actor $I, string $streetNumber): self
    {
        $I->fillField($this->streetNumberField, $streetNumber);
        return $this;
    }


    /**
     * @param Actor  $I
     * @param string $zipCode
     *
     * @return $this
     */
    private function fillZipCode(Actor $I, string $zipCode): self
    {
        $I->fillField($this->zipCodeField, $zipCode);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $city
     *
     * @return $this
     */
    private function fillCity(Actor $I, string $city): self
    {
        $I->fillField($this->cityField, $city);
        return $this;
    }


    /**
     * @param Actor  $I
     * @param string $additionalInfo
     *
     * @return $this
     */
    private function fillAdditionalInfo(Actor $I, string $additionalInfo): self
    {
        $I->fillField($this->additonalInformationField, $additionalInfo);
        return $this;
    }


    /**
     * @param Actor  $I
     * @param string $countryId
     *
     * @return $this
     */
    private function fillCountryId(Actor $I, string $countryId): self
    {
        $I->selectOption($this->companyIdField, $countryId);
        $I->seeOptionIsSelected($this->companyIdField, $countryId);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $phone
     *
     * @return $this
     */
    private function fillPhone(Actor $I, string $phone): self
    {
        $I->fillField($this->phoneField, $phone);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $fax
     *
     * @return $this
     */
    private function fillFax(Actor $I, string $fax): self
    {
        $I->fillField($this->faxField, $fax);
        return $this;
    }

}
