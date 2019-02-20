<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Component;

/**
 * Trait for user form
 * @package OxidEsales\Codeception\Page\Component
 */
trait UserForm
{
    // include form fields of current page
    public $userLoginNameField = ['id' => 'userLoginName'];
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
        $this->selectUserData($this->billUserSalutation, $userData['userSalutation'], '');
        unset($userData['userSalutation']);
        $this->selectBillingCountry($userData['countryId']);
        unset($userData['countryId']);
        if (isset($userData['stateId'])) {
            $this->selectUserData($this->billStateId, $userData['stateId'], '');
            unset($userData['stateId']);
        }

        foreach ($userData as $key => $value) {
            $locatorName = 'bill' . ucwords($key);
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
        $this->selectUserData($this->billCountryId, $country, '');
        return $this;
    }

    /**
     * @param string $country
     *
     * @return $this
     */
    public function selectShippingCountry(string $country)
    {
        $this->selectUserData($this->delCountryId, $country, '#shippingAddress');
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
        $this->selectUserData($this->delUserSalutation, $userData['userSalutation'], '#shippingAddress');
        unset($userData['userSalutation']);
        $this->selectShippingCountry($userData['countryId']);
        unset($userData['countryId']);
        if (isset($userData['stateId'])) {
            $this->selectUserData($this->delStateId, $userData['stateId'], '#shippingAddress');
            unset($userData['stateId']);
        }

        foreach ($userData as $key => $value) {
            $locatorName = 'del' . ucwords($key);
            $I->fillField($this->{$locatorName}, $value);
        }
        return $this;
    }

    /**
     * @param string $locator
     * @param string $value
     * @param string $valueLocator
     */
    private function selectUserData($locator, $value, $valueLocator)
    {
        $I = $this->user;
        $I->waitForElement($locator);
        $I->click($locator);
        $I->click($value, $valueLocator);
    }

    /**
     * @param int $month
     *
     * @return string
     */
    private function getBirthDateMonthItem($month)
    {
        return "//div[@class='btn-group bootstrap-select oxMonth form-control dropup open']/div/ul/li[".($month+1)."]/a";
    }
}
