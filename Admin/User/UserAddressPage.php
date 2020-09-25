<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\Component\AdminUserAddressesForm;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;

/**
 * Class Users
 *
 * @package OxidEsales\Codeception\Admin
 */
class UserAddressPage extends Page
{
    use UserList;
    use AdminUserAddressesForm;

    public $deleteAddressInput = "//input[@value='Delete']";
    public $addressesTabAddressSelect = 'oxaddressid';

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
        $I->seeInField($this->addressAdditonalInformationField, $adminUserAddress->getAdditionalInfo());
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
