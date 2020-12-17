<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component;

trait UserForm
{
    // include form fields of current page
    public $userLoginNameField = ['id' => 'userLoginName'];
    public $userNameField = 'invadr[oxuser__oxusername]';
    public $userPasswordField = ['id' => 'userPassword'];
    public $userPasswordConfirmField = ['id' => 'userPasswordConfirm'];

    //user data
    public $userUstIDField = 'invadr[oxuser__oxustid]';
    public $userMobFonField = 'invadr[oxuser__oxmobfon]';
    public $userPrivateFonField = 'invadr[oxuser__oxprivfon]';
    public $userBirthDateDayField = 'invadr[oxuser__oxbirthdate][day]';
    public $userBirthDateMonthField = "//div[@class='btn-group bootstrap-select oxMonth form-control']/button";
    public $userBirthDateYearField = 'invadr[oxuser__oxbirthdate][year]';

    //user address data
    public $billUserSalutation = '//button[@data-id="invadr_oxuser__oxfname"]';
    public $billUserFirstName = 'invadr[oxuser__oxfname]';
    public $billUserLastName = 'invadr[oxuser__oxlname]';
    public $billCompanyName = 'invadr[oxuser__oxcompany]';
    public $billStreetNr = 'invadr[oxuser__oxstreetnr]';
    public $billStreet = 'invadr[oxuser__oxstreet]';
    public $billZIP = 'invadr[oxuser__oxzip]';
    public $billCity = 'invadr[oxuser__oxcity]';
    public $billAdditionalInfo = 'invadr[oxuser__oxaddinfo]';
    public $billFonNr = 'invadr[oxuser__oxfon]';
    public $billFaxNr = 'invadr[oxuser__oxfax]';
    public $billCountryId = "//button[@data-id='invCountrySelect']";
    public $billStateId = "//button[@data-id='oxStateSelect_invadr[oxuser__oxstateid]']";

    //user delivery address data
    public $delUserSalutation = '//button[@data-id="deladr_oxaddress__oxsal"]';
    public $delUserFirstName = 'deladr[oxaddress__oxfname]';
    public $delUserLastName = 'deladr[oxaddress__oxlname]';
    public $delCompanyName = 'deladr[oxaddress__oxcompany]';
    public $delStreetNr = 'deladr[oxaddress__oxstreetnr]';
    public $delStreet = 'deladr[oxaddress__oxstreet]';
    public $delZIP = 'deladr[oxaddress__oxzip]';
    public $delCity = 'deladr[oxaddress__oxcity]';
    public $delAdditionalInfo = 'deladr[oxaddress__oxaddinfo]';
    public $delFonNr = 'deladr[oxaddress__oxfon]';
    public $delFaxNr = 'deladr[oxaddress__oxfax]';
    public $delCountryId = "//button[@data-id='delCountrySelect']";
    public $delStateId = "//button[@data-id='oxStateSelect_deladr[oxaddress__oxstateid]']";

    public $dropdownMenu = '[role=menu]';

    /**
     * @param string $userLoginName
     *
     * @return $this
     */
    public function enterUserLoginName(string $userLoginName)
    {
        $I = $this->user;
        $I->fillField($this->userLoginNameField, $userLoginName);
        return $this;
    }

    /**
     * @param string $name
     * @return $this
     */
    public function modifyUserName(string $name): self
    {
        $this->user->fillField($this->userNameField, $name);
        return $this;
    }

    /**
     * Fill fields with user login data.
     * $userData = [
     * 'userLoginNameField',
     * 'userPasswordField'
     * ]
     *
     * @param array $userData
     *
     * @return $this
     */
    public function enterUserLoginData(array $userData)
    {
        $I = $this->user;
        $I->fillField($this->userLoginNameField, $userData['userLoginNameField']);
        $I->fillField($this->userPasswordField, $userData['userPasswordField']);
        $I->fillField($this->userPasswordConfirmField, $userData['userPasswordField']);
        return $this;
    }

    /**
     * Fill fields with user information data.
     * $userData = [
     * 'userUstIDField',
     * 'userMobFonField',
     * 'userPrivateFonField',
     * 'userBirthDateDayField',
     * 'userBirthDateYearField',
     * 'userBirthDateMonthField'
     * ]
     *
     * @param array $userData
     *
     * @return $this
     */
    public function enterUserData(array $userData)
    {
        $I = $this->user;
        $I->fillField($this->userUstIDField, $userData['userUstIDField']);
        $I->fillField($this->userMobFonField, $userData['userMobFonField']);
        $I->fillField($this->userPrivateFonField, $userData['userPrivateFonField']);

        $I->fillField($this->userBirthDateDayField, $userData['userBirthDateDayField']);
        $I->fillField($this->userBirthDateYearField, $userData['userBirthDateYearField']);

        $I->click($this->userBirthDateMonthField);
        $I->click($this->getBirthDateMonthItem($userData['userBirthDateMonthField']));
        return $this;
    }

    /**
     * Fill fields with user billing address data.
     * $userData = [
     *  "userSalutation",
     *  "userFirstName",
     *  "userLastName",
     *  "companyName",
     *  "street",
     *  "streetNr",
     *  "ZIP",
     *  "city",
     *  "additionalInfo",
     *  "fonNr",
     *  "faxNr",
     *  "countryId",
     * ]
     *
     * @param array $userData
     *
     * @return $this
     */
    public function enterAddressData(array $userData)
    {
        $I = $this->user;
        $this->selectBillingAddressSalutation($userData['userSalutation']);
        $this->selectBillingCountry($userData['countryId']);
        if (isset($userData['stateId'])) {
            $this->selectBillingAddressState($userData['stateId']);
        }

        foreach ($this->removeSelectFieldsFromUserData($userData) as $textField => $value) {
            $locatorName = 'bill' . ucwords($textField);
            $I->fillField($this->{$locatorName}, $value);
        }
        return $this;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function selectBillingCountry(string $country)
    {
        $I = $this->user;
        $this->openDropdown($this->billCountryId);
        $I->retryClick($country);
        return $this;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function selectShippingCountry(string $country)
    {
        $I = $this->user;
        $this->openDropdown($this->delCountryId);
        $I->retryClick($country, '#shippingAddress');
        return $this;
    }

    /**
     * Fill fields with user shipping address data.
     * $userData = [
     *  "userSalutation",
     *  "userFirstName",
     *  "userLastName",
     *  "companyName",
     *  "street",
     *  "streetNr",
     *  "ZIP",
     *  "city",
     *  "additionalInfo",
     *  "fonNr",
     *  "faxNr",
     *  "countryId",
     * ]
     *
     * @param array $userData
     *
     * @return $this
     */
    public function enterShippingAddressData(array $userData)
    {
        $I = $this->user;
        $this->selectShippingAddressSalutation($userData['userSalutation']);
        $this->selectShippingCountry($userData['countryId']);
        if (isset($userData['stateId'])) {
            $this->selectShippingAddressState($userData['stateId']);
        }

        foreach ($this->removeSelectFieldsFromUserData($userData) as $textField => $value) {
            $locatorName = 'del' . ucwords($textField);
            $I->fillField($this->{$locatorName}, $value);
        }
        return $this;
    }

    private function openDropdown(string $dropdown): void
    {
        $I = $this->user;
        $I->waitForElement($dropdown);
        $I->scrollTo($dropdown);
        $I->retryClick($dropdown);
        $I->waitForElement($this->dropdownMenu);
    }

    /**
     * @param int $month
     *
     * @return string
     */
    private function getBirthDateMonthItem($month): string
    {
        return "//div[@class='btn-group bootstrap-select oxMonth form-control dropup open']/div/ul/li["
            . ($month + 1)
            . ']/a';
    }

    private function selectBillingAddressSalutation($userSalutation): void
    {
        $I = $this->user;
        $this->openDropdown($this->billUserSalutation);
        $I->retryClick($userSalutation);
    }

    private function selectBillingAddressState($stateId): void
    {
        $I = $this->user;
        $this->openDropdown($this->billStateId);
        $I->retryClick($stateId);
    }

    private function removeSelectFieldsFromUserData(array $userData): array
    {
        unset($userData['userSalutation'], $userData['countryId'], $userData['stateId']);
        return $userData;
    }

    private function selectShippingAddressSalutation($userSalutation): void
    {
        $I = $this->user;
        $this->openDropdown($this->delUserSalutation);
        $I->retryClick($userSalutation, '#shippingAddress');
    }

    private function selectShippingAddressState($stateId): void
    {
        $I = $this->user;
        $this->openDropdown($this->delStateId);
        $I->retryClick($stateId, '#shippingAddress');
    }
}
