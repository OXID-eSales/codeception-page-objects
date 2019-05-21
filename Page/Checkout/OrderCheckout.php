<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for final order step
 * @package OxidEsales\Codeception\Page\Checkout
 */
class OrderCheckout extends Page
{
    // include url of current page
    public $URL = '/index.php?cl=order&lang=1';

    public $billingAddress = '//div[@id="orderAddress"]/div[1]/form/div[2]/div[2]';

    public $deliveryAddress = '//div[@id="orderAddress"]/div[2]/form/div[2]/div[2]';

    public $userRemarkHeader = '//div[@class="panel panel-default orderRemarks"]/div[1]/h3';

    public $userRemark = '//div[@class="panel panel-default orderRemarks"]/div[2]';

    public $previousStepLink = '//li[@class="step3 passed "]/a[1]';

    /**
     * Clicks on submit order button.
     *
     * @return $this
     */
    public function submitOrder()
    {
        $I = $this->user;
        $I->click(Translator::translate('SUBMIT_ORDER'));
        return $this;
    }

    /**
     * Opens previous page: payment checkout.
     *
     * @return PaymentCheckout
     */
    public function goToPreviousStep()
    {
        $I = $this->user;
        $I->click($this->previousStepLink);
        $I->waitForElement($this->breadCrumb);
        return new PaymentCheckout($I);
    }

    /**
     * Checks if user billing address is correctly displayed.
     * $userBillAddress = [
     *  "userLoginNameField"
     *  "userUstIDField" => "",
     *  "userMobFonField" => "",
     *  "userPrivateFonField" => "11111111$userId",
     *  "userBirthDateDayField" => rand(10, 28),
     *  "userBirthDateMonthField" => rand(10, 12),
     *  "userBirthDateYearField" => rand(1960, 2000),
     *  "userSalutation" => 'Mrs',
     *  "userFirstName" => "user$userId name_šÄßüл",
     *  "userLastName" => "user$userId last name_šÄßüл",
     *  "companyName" => "user$userId company_šÄßüл",
     *  "street" => "user$userId street_šÄßüл",
     *  "streetNr" => "$userId-$userId",
     *  "ZIP" => "1234$userId",
     *  "city" => "user$userId city_šÄßüл",
     *  "additionalInfo" => "user$userId additional info_šÄßüл",
     *  "fonNr" => "111-111-$userId",
     *  "faxNr" => "111-111-111-$userId",
     *  "countryId" => $userCountry
     *  ];
     *
     * @param array $userBillAddress
     *
     * @return $this
     */
    public function validateUserBillingAddress($userBillAddress)
    {
        $I = $this->user;
        $addressInfo = $this->convertBillInformationIntoString($userBillAddress);
        $I->assertEquals($I->clearString($addressInfo), $I->clearString($I->grabTextFrom($this->billingAddress)));
        return $this;
    }

    /**
     * Checks if user shipping address is correctly displayed.
     * $userDelAddress = [
     *  "userSalutation" => 'Mrs',
     *  "userFirstName" => "user$userId name_šÄßüл",
     *  "userLastName" => "user$userId last name_šÄßüл",
     *  "companyName" => "user$userId company_šÄßüл",
     *  "street" => "user$userId street_šÄßüл",
     *  "streetNr" => "$userId-$userId",
     *  "ZIP" => "1234$userId",
     *  "city" => "user$userId city_šÄßüл",
     *  "additionalInfo" => "user$userId additional info_šÄßüл",
     *  "fonNr" => "111-111-$userId",
     *  "faxNr" => "111-111-111-$userId",
     *  "countryId" => $userCountry
     *  ];
     *
     * @param array $userDelAddress
     *
     * @return $this
     */
    public function validateUserDeliveryAddress($userDelAddress)
    {
        $I = $this->user;
        $addressInfo = $this->convertDeliveryAddressIntoString($userDelAddress);
        $I->assertEquals($I->clearString($addressInfo), $I->clearString($I->grabTextFrom($this->deliveryAddress)));
        return $this;
    }

    /**
     * @param string $userRemarkText
     * @return $this
     */
    public function validateRemarkText($userRemarkText)
    {
        $I = $this->user;
        $I->see(Translator::translate('WHAT_I_WANTED_TO_SAY'), $this->userRemarkHeader);
        $I->see($userRemarkText, $this->userRemark);
        return $this;
    }

    /**
     * Forms a string from billing address information array.
     *
     * @param array $userAddress
     *
     * @return string
     */
    private function convertBillInformationIntoString($userAddress)
    {
        $transformedAddress = $this->convertAddressArrayIntoString($userAddress);
        $transformedAddress .= Translator::translate('EMAIL').' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'userLoginNameField');
        $transformedAddress .= Translator::translate('PHONE').' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'fonNr');
        $transformedAddress .= Translator::translate('FAX').' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'faxNr');
        $transformedAddress .= Translator::translate('CELLUAR_PHONE').' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'userMobFonField');
        $transformedAddress .= Translator::translate('PERSONAL_PHONE').' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'userPrivateFonField');
        return $transformedAddress;
    }

    /**
     * Forms a string from delivery address information array.
     *
     * @param array $userAddress
     *
     * @return string
     */
    private function convertDeliveryAddressIntoString($userAddress)
    {
        $transformedAddress = $this->convertAddressArrayIntoString($userAddress);
        $transformedAddress .= Translator::translate('PHONE').' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'fonNr');
        $transformedAddress .= Translator::translate('FAX').' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'faxNr');
        return $transformedAddress;
    }

    /**
     * Forms a string from address information array.
     *
     * @param array $userAddress
     *
     * @return string
     */
    private function convertAddressArrayIntoString($userAddress)
    {
        $transformedAddress = $this->getAddressElement($userAddress, 'companyName');
        $transformedAddress .= $this->getAddressElement($userAddress, 'additionalInfo');
        $transformedAddress .= $this->getAddressElement($userAddress, 'userUstIDField', Translator::translate('VAT_ID_NUMBER').' ');
        $transformedAddress .= $this->getAddressElement($userAddress, 'userSalutation');
        $transformedAddress .= $this->getAddressElement($userAddress, 'userFirstName');
        $transformedAddress .= $this->getAddressElement($userAddress, 'userLastName');
        $transformedAddress .= $this->getAddressElement($userAddress, 'street');
        $transformedAddress .= $this->getAddressElement($userAddress, 'streetNr');
        $transformedAddress .= (isset($userAddress['stateId']) && $userAddress['stateId']) ? 'BE ': '';
        $transformedAddress .= $this->getAddressElement($userAddress, 'ZIP');
        $transformedAddress .= $this->getAddressElement($userAddress, 'city');
        $transformedAddress .= $this->getAddressElement($userAddress, 'countryId');
        return $transformedAddress;
    }

    /**
     * Returns address element value if is set.
     *
     * @param array  $address
     * @param string $element
     * @param string $label
     *
     * @return string
     */
    private function getAddressElement($address, $element, $label = '')
    {
        return (isset($address[$element]) && $address[$element]) ? $label.$address[$element].' ': '';
    }
}
