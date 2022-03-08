<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class UserAddressPage extends Page
{
    use UserList;

    public $deleteAddressInput = "//input[@value='Delete']";
    public $addressesTabAddressSelect = 'oxaddressid';
    public string $addressTitleField = "//select[@name='editval[oxaddress__oxsal]']";
    public string $addressFirstNameField = "//input[@name='editval[oxaddress__oxfname]']";
    public string $addressLastNameField = "//input[@name='editval[oxaddress__oxlname]']";
    public string $addressCompanyField = "//input[@name='editval[oxaddress__oxcompany]']";
    public string $addressStreetField = "//input[@name='editval[oxaddress__oxstreet]']";
    public string $addressStreetNumberField = "//input[@name='editval[oxaddress__oxstreetnr]']";
    public string $addressZipCodeField = "//input[@name='editval[oxaddress__oxzip]']";
    public string $addressCityField = "//input[@name='editval[oxaddress__oxcity]']";
    public string $addressAdditionalInformationField = "//input[@name='editval[oxaddress__oxaddinfo]']";
    public string $addressCountryIdField = "//select[@name='editval[oxaddress__oxcountryid]']";
    public string $addressPhoneField = "//input[@name='editval[oxaddress__oxfon]']";
    public string $addressFaxField = "//input[@name='editval[oxaddress__oxfax]']";

    /**
     * @return $this
     */
    public function deleteSelectedAddress(): self
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->deleteAddressInput);

        $I->selectEditFrame();

        return $this;
    }

    /**
     * @param AdminUserAddresses $adminUserAddress
     * @return $this
     */
    public function selectAddress(AdminUserAddresses $adminUserAddress): self
    {
        $I = $this->user;

        $I->selectOption($this->addressesTabAddressSelect, $this->getAddressTitle($adminUserAddress));

        return $this;
    }

    /**
     * @param AdminUserAddresses $adminUserAddresses
     * @return $this
     */
    public function editUserAddress(AdminUserAddresses $adminUserAddresses): self
    {
        $I = $this->user;

        $I->selectOption($this->addressTitleField, $adminUserAddresses->getTitle());
        $I->fillField($this->addressFirstNameField, $adminUserAddresses->getFirstName());
        $I->fillField($this->addressLastNameField, $adminUserAddresses->getLastName());
        $I->fillField($this->addressCompanyField, $adminUserAddresses->getCompany());
        $I->fillField($this->addressStreetField, $adminUserAddresses->getStreet());
        $I->fillField($this->addressStreetNumberField, $adminUserAddresses->getStreetNumber());
        $I->fillField($this->addressZipCodeField, $adminUserAddresses->getZip());
        $I->fillField($this->addressCityField, $adminUserAddresses->getCity());
        $I->fillField($this->addressAdditionalInformationField, $adminUserAddresses->getAdditionalInfo());
        $I->selectOption($this->addressCountryIdField, $adminUserAddresses->getCountryId());
        $I->fillField($this->addressPhoneField, $adminUserAddresses->getPhone());
        $I->fillField($this->addressFaxField, $adminUserAddresses->getFax());

        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->waitForDocumentReadyState();

        return $this;
    }

    /**
     * @param AdminUserAddresses $adminUserAddress
     * @return $this
     */
    public function seeAddressInformation(AdminUserAddresses $adminUserAddress): self
    {
        $I = $this->user;

        $I->seeOptionIsSelected(
            $this->addressesTabAddressSelect,
            $this->getAddressTitle($adminUserAddress)
        );
        $I->seeOptionIsSelected($this->addressTitleField, $adminUserAddress->getTitle());
        $I->seeInField($this->addressFirstNameField, $adminUserAddress->getFirstName());
        $I->seeInField($this->addressLastNameField, $adminUserAddress->getLastName());
        $I->seeInField($this->addressCompanyField, $adminUserAddress->getCompany());
        $I->seeInField($this->addressStreetField, $adminUserAddress->getStreet());
        $I->seeInField($this->addressStreetNumberField, $adminUserAddress->getStreetNumber());
        $I->seeInField($this->addressZipCodeField, $adminUserAddress->getZip());
        $I->seeInField($this->addressCityField, $adminUserAddress->getCity());
        $I->seeOptionIsSelected($this->addressCountryIdField, $adminUserAddress->getCountryId());
        $I->seeInField($this->addressAdditionalInformationField, $adminUserAddress->getAdditionalInfo());
        $I->seeInField($this->addressPhoneField, $adminUserAddress->getPhone());
        $I->seeInField($this->addressFaxField, $adminUserAddress->getFax());

        return $this;
    }

    private function getAddressTitle(AdminUserAddresses $adminUserAddress)
    {
        $title = '-';
        if ($adminUserAddress->getFirstName()) {
            $title = $adminUserAddress->getFirstName() . ' '
                . $adminUserAddress->getLastName() . ', '
                . $adminUserAddress->getStreet() . ', '
                . $adminUserAddress->getCity();
        }
        return $title;
    }
}
