<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Account\Component\AccountNavigation;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Modal;
use OxidEsales\Codeception\Page\Component\UserForm;
use OxidEsales\Codeception\Page\Page;

class UserAddress extends Page
{
    use AccountMenu;
    use AccountNavigation;
    use Modal;
    use UserForm;

    public string $URL = '/en/my-address/';
    public string $breadCrumb = '.breadcrumb';
    public string $headerTitle = 'h1';
    public string $openBillingAddressFormButton = '#userChangeAddress';
    public string $userEmail = 'invadr[oxuser__oxusername]';
    public string $userPassword = '#user_password';
    public string $saveUserAddressButton = '#accUserSaveTop';
    public string $billingAddress = '#addressText';
    public string $shippingAddress = '//div[@id="shippingAddress"]/div[1]/div[%s]/div/div[1]';
    public string $openShipAddressPanel = '#showShipAddress';
    public string $shipAddressPanel = '#shippingAddress';
    public string $shipAddressForm = '#shippingAddressForm';
    public string $openShipAddressForm =
        '//div[@id="shippingAddress"]/div[%s]//button[contains(@class,"dd-edit-shipping-address")]';
    public string $deleteShipAddress =
        '//div[@id="shippingAddress"]/div[%s]//button[contains(@class,"dd-delete-shipping-address")]';
    public string $selectShipAddress =
        '//div[@id="shippingAddress"]/div[%s]//label[contains(@class,"setToThisShippingAddress")]';
    public string $newShipAddressForm =
        '//div[@class="panel panel-default dd-add-delivery-address"]';
    private string $panelsWithShippingAddresses =
        '//div[@id="shippingAddress"]//label[contains(@class,"setToThisShippingAddress")]';

    public function openUserBillingAddressForm()
    {
        $I = $this->user;
        $I->clickAndWait($this->openBillingAddressFormButton);
        $I->waitForElementVisible($this->billCountryId);
        return $this;
    }

    public function openShippingAddressForm()
    {
        $I = $this->user;
        $I->clickAndWait($this->openShipAddressPanel);
        $I->waitForElementVisible($this->shipAddressPanel);
        $I->dontSeeCheckboxIsChecked($this->openShipAddressPanel);
        return $this;
    }

    public function selectNewShippingAddress()
    {
        $I = $this->user;
        $I->clickAndWait($this->newShipAddressForm);
        $I->waitForElementVisible($this->shipAddressForm);
        return $this;
    }

    public function selectShippingAddress(int $position)
    {
        $I = $this->user;
        $selectAddressBtn = sprintf($this->selectShipAddress, $position);
        $I->waitForElementClickable($selectAddressBtn);
        $I->clickAndWait($selectAddressBtn);
        $openFormBtn = sprintf($this->openShipAddressForm, $position);
        $I->waitForElementClickable($openFormBtn);
        $I->clickAndWait($openFormBtn);
        $I->waitForElementVisible($this->shipAddressForm);
        return $this;
    }

    public function deleteShippingAddress(int $position)
    {
        $I = $this->user;
        $selectBtn = sprintf($this->selectShipAddress, $position);
        $I->waitForElementClickable($selectBtn);
        $I->clickAndWait($selectBtn);
        $deleteBtn = sprintf($this->deleteShipAddress, $position);
        $I->waitForElementClickable($deleteBtn);
        $I->clickAndWait($deleteBtn);
        $this->confirmShippingAddressDeletion($position);
        return $this;
    }

    public function saveAddress()
    {
        $I = $this->user;
        $I->clickAndWait($this->saveUserAddressButton);

        return $this;
    }

    public function changeEmail(string $newEmail, string $password)
    {
        $I = $this->user;
        $I->fillField($this->userEmail, $newEmail);
        $I->waitForPageLoad();
        $I->waitForElementVisible($this->userPassword);
        $I->fillField($this->userPassword, $password);
        return $this->saveAddress();
    }

    public function validateUserBillingAddress(array $userBillAddress)
    {
        $I = $this->user;
        $addressInfo = $this->convertBillInformationIntoString($userBillAddress);
        $I->assertEquals($I->clearString($addressInfo), $I->clearString($I->grabTextFrom($this->billingAddress)));
        return $this;
    }

    public function validateUserDeliveryAddress(array $userDelAddress, int $id = 1)
    {
        $I = $this->user;
        $addressInfo = $this->convertDeliveryAddressIntoString($userDelAddress);
        $selectedShippingAddress = sprintf($this->shippingAddress, $id);
        $I->assertEquals($I->clearString($addressInfo), $I->clearString($I->grabTextFrom($selectedShippingAddress)));
        return $this;
    }

    public function seeNumberOfShippingAddresses(int $cnt): self
    {
        $I = $this->user;
        $I->seeNumberOfElements($this->panelsWithShippingAddresses, $cnt);
        return $this;
    }

    private function convertBillInformationIntoString(array $userAddress): string
    {
        $transformedAddress = $this->convertAddressArrayIntoString($userAddress);
        $transformedAddress .= Translator::translate('EMAIL') . ' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'userLoginNameField');
        $transformedAddress .= Translator::translate('PHONE') . ' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'fonNr');
        $transformedAddress .= ' | ' . Translator::translate('FAX') . ' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'faxNr');
        $transformedAddress .= Translator::translate('CELLUAR_PHONE') . ' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'userMobFonField');
        $transformedAddress .= Translator::translate('PERSONAL_PHONE') . ' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'userPrivateFonField');
        return $transformedAddress;
    }

    private function convertDeliveryAddressIntoString(array $userAddress): string
    {
        $transformedAddress = $this->convertAddressArrayIntoString($userAddress);
        $transformedAddress .= Translator::translate('PHONE') . ' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'fonNr');
        $transformedAddress .= Translator::translate('FAX') . ' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'faxNr');
        return $transformedAddress;
    }

    private function convertAddressArrayIntoString(array $userAddress): string
    {
        $transformedAddress = $this->getAddressElement($userAddress, 'companyName');
        $transformedAddress .= $this->getAddressElement($userAddress, 'additionalInfo');
        $transformedAddress .= $this->getAddressElement(
            $userAddress,
            'userUstIDField',
            Translator::translate('VAT_ID_NUMBER') . ' '
        );
        $transformedAddress .= $this->getAddressElement($userAddress, 'userSalutation');
        $transformedAddress .= $this->getAddressElement($userAddress, 'userFirstName');
        $transformedAddress .= $this->getAddressElement($userAddress, 'userLastName');
        $transformedAddress .= $this->getAddressElement($userAddress, 'street');
        $transformedAddress .= $this->getAddressElement($userAddress, 'streetNr');
        $transformedAddress .= (isset($userAddress['stateId']) && $userAddress['stateId']) ? 'BE ' : '';
        $transformedAddress .= $this->getAddressElement($userAddress, 'ZIP');
        $transformedAddress .= $this->getAddressElement($userAddress, 'city');
        $transformedAddress .= $this->getAddressElement($userAddress, 'countryId');
        return $transformedAddress;
    }

    private function getAddressElement(array $address, string $element, string $label = ''): string
    {
        return (isset($address[$element])) ? $label . $address[$element] . ' ' : '';
    }
}
