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

/**
 * Trait for user form
 *
 * @package OxidEsales\Codeception\Page\Component
 */
trait AdminUserForm
{
    Public $activeField = 'editval[oxuser__oxactive]';
    Public $usernameField = 'editval[oxuser__oxusername]';
    Public $customerNumberField = 'editval[oxuser__oxcustnr]';
    Public $titleField = 'editval[oxuser__oxsal]';
    Public $firstNameField = 'editval[oxuser__oxfname]';
    Public $lastNameField = 'editval[oxuser__oxlname]';
    Public $companyField = 'editval[oxuser__oxcompany]';
    Public $streetField = 'editval[oxuser__oxstreet]';
    Public $streetNumberField = 'editval[oxuser__oxstreetnr]';
    Public $zipCodeField = 'editval[oxuser__oxzip]';
    Public $cityField = 'editval[oxuser__oxcity]';
    Public $ustidField = 'editval[oxuser__oxustid]';
    Public $additonalInformationField = 'editval[oxuser__oxaddinfo]';
    Public $companyIdField = 'editval[oxuser__oxcountryid]';
    Public $stateIdField = 'editval[oxuser__oxstateid]';
    Public $phoneField = 'editval[oxuser__oxfon]';
    Public $faxField = 'editval[oxuser__oxfax]';
    Public $birthDayField = 'editval[oxuser__oxbirthdate][day]';
    Public $birthMonthField = 'editval[oxuser__oxbirthdate][month]';
    Public $birthYearField = 'editval[oxuser__oxbirthdate][year]';
    Public $passwordField = 'newPassword';
    Public $userRightsField = 'editval[oxuser__oxrights]';
    public $newButton  = '#btn.new';

    /**
     * @param Actor     $I
     * @param AdminUser $adminUser
     */
    public function fillAdminUserForm(Actor $I, AdminUser $adminUser): void
    {
        $this->fillActive($I, $adminUser->getActive());

        if($adminUser->getUsername() != NULL){
            $this->fillUsername($I, $adminUser->getUsername());
        }

        if($adminUser->getCustomerNumber() != NULL){
            $this->fillCustomerNumber($I, $adminUser->getCustomerNumber());
        }

        if($adminUser->getTitle() != NULL){
            $this->fillTitle($I, $adminUser->getTitle());
        }

        if($adminUser->getFirstName() != NULL){
            $this->fillFirstName($I, $adminUser->getFirstName());
        }

        if($adminUser->getFamilyName() != NULL){
            $this->fillFamilyName($I, $adminUser->getFamilyName());
        }

        if($adminUser->getCompany() != NULL){
            $this->fillCompany($I, $adminUser->getCompany());
        }

        if($adminUser->getStreet() != NULL){
            $this->fillStreet($I, $adminUser->getStreet());
        }

        if($adminUser->getStreetNumber() != NULL){
            $this->fillStreetNumber($I, $adminUser->getStreetNumber());
        }

        if($adminUser->getZipCode() != NULL){
            $this->fillZipCode($I, $adminUser->getZipCode());
        }

        if($adminUser->getCity() != NULL){
            $this->fillCity($I, $adminUser->getCity());
        }

        if($adminUser->getUstid() != NULL){
            $this->fillUstid($I, $adminUser->getUstid());
        }

        if($adminUser->getAdditionalInfo() != NULL){
            $this->fillAdditionalInfo($I, $adminUser->getAdditionalInfo());
        }

        if($adminUser->getCountryId() != NULL){
            $this->fillCountryId($I, $adminUser->getCountryId());
        }

        if($adminUser->getStateId() != NULL){
            $this->fillStateId($I, $adminUser->getStateId());
        }

        if($adminUser->getPhone() != NULL){
            $this->fillPhone($I, $adminUser->getPhone());
        }

        if($adminUser->getFax() != NULL){
            $this->fillFax($I, $adminUser->getFax());
        }

        if($adminUser->getBirthday() != NULL){
            $this->fillBirthday($I, $adminUser->getBirthday());
        }

        if($adminUser->getBirthday() != NULL){
            $this->fillBirthMonth($I, $adminUser->getBirthMonth());
        }

        if($adminUser->getBirthYear() != NULL){
            $this->fillBirthYear($I, $adminUser->getBirthYear());
        }

        if($adminUser->getPassword() != NULL){
            $this->fillPassword($I, $adminUser->getPassword());
        }

        if($adminUser->getUserRights() != NULL){
            $this->fillUserRights($I, $adminUser->getUserRights());
        }
    }

    /**
     * @param Actor $I
     * @param bool  $active
     *
     * @return $this
     */
    private function fillActive(Actor $I, bool $active): self
    {
        ($active) ? $I->checkOption($this->activeField) : $I->uncheckOption($this->activeField);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $username
     *
     * @return $this
     */
    private function fillUsername(Actor $I, string $username): self
    {
        $I->fillField($this->usernameField, $username);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $customerNumber
     *
     * @return $this
     */
    private function fillCustomerNumber(Actor $I, string $customerNumber): self
    {
        $I->fillField($this->customerNumberField, $customerNumber);
        return $this;
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
    private function fillFamilyName(Actor $I, string $familyName): self
    {
        $I->fillField($this->lastNameField, $familyName);
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
     * @param string $ustid
     *
     * @return $this
     */
    private function fillUstid(Actor $I, string $ustid): self
    {
        $I->fillField($this->ustidField, $ustid);
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
     * @param string $stateId
     *
     * @return $this
     */
    private function fillStateId(Actor $I, string $stateId): self
    {
        $I->fillField($this->stateIdField, $stateId);
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

    /**
     * @param Actor  $I
     * @param string $birthday
     *
     * @return $this
     */
    private function fillBirthday(Actor $I, string $birthday): self
    {
        $I->fillField($this->birthDayField, $birthday);
        return $this;
    }


    /**
     * @param Actor  $I
     * @param string $birthMonth
     *
     * @return $this
     */
    private function fillBirthMonth(Actor $I, string $birthMonth): self
    {
        $I->fillField($this->birthMonthField, $birthMonth);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $birthYear
     *
     * @return $this
     */
    private function fillBirthYear(Actor $I, string $birthYear): self
    {
        $I->fillField($this->birthYearField, $birthYear);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $password
     *
     * @return $this
     */
    private function fillPassword(Actor $I, string $password): self
    {
        $I->fillField($this->passwordField, $password);
        return $this;
    }

    /**
     * @param Actor  $I
     * @param string $userRights
     *
     * @return $this
     */
    private function fillUserRights(Actor $I, string $userRights): self
    {
        $I->selectOption($this->userRightsField, $userRights);
        $I->seeOptionIsSelected($this->userRightsField, $userRights);
        return $this;
    }

}
