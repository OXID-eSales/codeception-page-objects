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

    public $paymentMethod = '#orderPayment';

    public $shippingMethod = '#orderShipping';

    public $basketItemTotalPrice = '//tr[@id="table_cartItem_%s"]/td[@class="totalPrice"]';

    public $basketItemTitle = '//tr[@id="table_cartItem_%s"]/td[1]/div[2]/b';

    public $basketItemId = '//tr[@id="table_cartItem_%s"]/td[1]/div[2]/div[1]';

    public $basketItemAmount = '//tr[@id="table_cartItem_%s"]/td[@class="quantity"]';

    public $basketSummaryNet = '#basketTotalProductsNetto';

    public $basketSummaryVat = '//div[@id="basketSummary"]//tr[%s]/td';

    public $basketSummaryGross = '#basketTotalProductsGross';

    public $basketShippingGross = '#basketDeliveryGross';

    public $basketPaymentGross = '#basketPaymentGross';

    public $basketWrappingGross = '#basketWrappingGross';

    public $basketGiftCardGross = '#basketGiftCardGross';

    public $basketTotalPrice = '#basketGrandTotal';

    public $couponInformation = '.couponData';

    public $previousStepLink = '//li[@class="step3 passed "]/a/div[2]';

    public $editBillingAddress = '//div[@id="orderAddress"]/div[1]//button';

    public $editPayment = '//div[@id="orderShipping"]/div[1]//button';

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
    public function goToPreviousStep(): PaymentCheckout
    {
        $I = $this->user;
        $I->click($this->previousStepLink);
        $paymentPage = new PaymentCheckout($I);
        $I->waitForElement($paymentPage->breadCrumb);
        return $paymentPage;
    }

    /**
     * Opens page: user checkout.
     *
     * @return UserCheckout
     */
    public function editUserAddress(): UserCheckout
    {
        $I = $this->user;
        $I->click($this->editBillingAddress);
        $userPage = new UserCheckout($I);
        $I->waitForElement($userPage->breadCrumb);
        return $userPage;
    }

    /**
     * Opens page: payment checkout.
     *
     * @return PaymentCheckout
     */
    public function editPaymentMethod(): PaymentCheckout
    {
        $I = $this->user;
        $I->click($this->previousStepLink);
        $paymentPage = new PaymentCheckout($I);
        $I->waitForElement($paymentPage->breadCrumb);
        return $paymentPage;
    }

    /**
     * Asset payment method
     *
     * @param string $paymentMethod
     *
     * @return $this
     */
    public function validatePaymentMethod(string $paymentMethod)
    {
        $I = $this->user;
        $I->see($paymentMethod, $this->paymentMethod);
        return $this;
    }

    /**
     * Asset shipping method
     *
     * @param string $shippingMethod
     *
     * @return $this
     */
    public function validateShippingMethod(string $shippingMethod)
    {
        $I = $this->user;
        $I->see($shippingMethod, $this->shippingMethod);
        return $this;
    }

    /**
     * Asset coupon information
     *
     * @param string $couponId
     * @param string $couponDiscount
     *
     * @return $this
     */
    public function validateCoupon(string $couponId, string $couponDiscount)
    {
        $I = $this->user;
        $informationText = sprintf('%s (%s %s) %s',
            Translator::translate('COUPON'),
            Translator::translate('NUMBER'),
            $couponId,
            $couponDiscount);
        $I->see($informationText, $this->couponInformation);
        return $this;
    }

    /**
     * Asset vat information
     *
     * @param array $vatInformation An Array of the Vat amount
     *
     * @return $this
     */
    public function validateVat(array $vatInformation)
    {
        $I = $this->user;
        $position = 2;
        foreach ($vatInformation as $vatAmount) {
            $I->see($vatAmount, sprintf($this->basketSummaryVat, $position));
            $position++;
        }
        return $this;
    }

    /**
     * Assert order product
     *
     * $basketProducts[] = ['id' => productId,
     *                   'title' => productTitle,
     *                   'amount' => productAmount,
     *                   'totalPrice' => productTotalPrice]
     *
     * @param array $basketProducts
     *
     * @return $this
     */
    public function validateOrderItems(array $basketProducts)
    {
        $I = $this->user;
        foreach ($basketProducts as $key => $basketProduct) {
            $itemPosition = $key + 1;
            $I->see(Translator::translate('PRODUCT_NO') . ' ' . $basketProduct['id'], sprintf($this->basketItemId, $itemPosition));
            $I->see($basketProduct['title'], sprintf($this->basketItemTitle, $itemPosition));
            $I->see($basketProduct['totalPrice'], sprintf($this->basketItemTotalPrice, $itemPosition));
            $I->see($basketProduct['amount'], sprintf($this->basketItemAmount, $itemPosition));
        }
        return $this;
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
    public function validateUserBillingAddress(array $userBillAddress)
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
    public function validateUserDeliveryAddress(array $userDelAddress)
    {
        $I = $this->user;
        $addressInfo = $this->convertDeliveryAddressIntoString($userDelAddress);
        $I->assertEquals($I->clearString($addressInfo), $I->clearString($I->grabTextFrom($this->deliveryAddress)));
        return $this;
    }

    /**
     * @param string $userRemarkText
     *
     * @return $this
     */
    public function validateRemarkText(string $userRemarkText)
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
