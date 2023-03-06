<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class OrderCheckout extends Page
{
    public $URL = '/index.php?cl=order&lang=1';
    public string $billingAddress = '//div[@id="orderAddress"]/div[1]/form/div[2]/div[2]';
    public string $deliveryAddress = '//div[@id="orderAddress"]/div[2]/form/div[2]/div[2]';
    public string $userRemarkHeader = '//div[@class="panel panel-default orderRemarks"]/div[1]/h3';
    public string $userRemark = '//div[@class="panel panel-default orderRemarks"]/div[2]';
    public string $paymentMethod = '#orderPayment';
    public string $shippingMethod = '#orderShipping';
    public string $basketItemTotalPrice = '//tr[@id="table_cartItem_%s"]/td[@class="totalPrice"]';
    public string $basketItemTitle = '//tr[@id="table_cartItem_%s"]/td[1]/div[2]/b';
    public string $basketItemId = '//tr[@id="table_cartItem_%s"]/td[1]/div[2]/div[1]';
    public string $basketItemAmount = '//tr[@id="table_cartItem_%s"]/td[@class="quantity"]';
    public string $basketSummaryNet = '#basketTotalProductsNetto';
    public string $basketSummaryVat = '//div[@id="basketSummary"]//tr[%s]/td';
    public string $basketSummaryGross = '#basketTotalProductsGross';
    public string $basketShippingGross = '#basketDeliveryGross';
    public string $basketPaymentGross = '#basketPaymentGross';
    public string $basketWrappingGross = '#basketWrappingGross';
    public string $basketGiftCardGross = '#basketGiftCardGross';
    public string $basketTotalPrice = '#basketGrandTotal';
    public string $couponInformation = '.couponData';
    public string $previousStepLink = '//li[@class="step3 passed "]/a/div[2]';
    public string $editBillingAddress = '//div[@id="orderAddress"]/div[1]//button';
    public string $editPayment = '//div[@id="orderPayment"]//button';
    public string $editShippingMethod = '//div[@id="orderShipping"]//button';
    public string $downloadableProductsAgreement = '#oxdownloadableproductsagreement';
    public string $submitOrder = '//button[contains(@class,"btn-highlight")]';

    public function submitOrder(): self
    {
        $I = $this->user;
        $I->waitForText(Translator::translate('SUBMIT_ORDER'));
        $I->click(Translator::translate('SUBMIT_ORDER'));
        $I->waitForPageLoad();
        return $this;
    }

    public function submitOrderSuccessfully(): ThankYou
    {
        $I = $this->user;
        $thankYouPage = new ThankYou($I);
        $this->submitOrder();
        $this->seeOnBreadCrumb(Translator::translate('ORDER_COMPLETED'));
        $I->waitForElement($thankYouPage->thankYouPage);
        return $thankYouPage;
    }

    public function confirmDownloadableProductsAgreement(): self
    {
        $I = $this->user;
        $I->checkOption($this->downloadableProductsAgreement);
        return $this;
    }

    public function goToPreviousStep(): PaymentCheckout
    {
        $I = $this->user;
        $I->click($this->previousStepLink);
        $paymentPage = new PaymentCheckout($I);
        $I->waitForElement($paymentPage->breadCrumb);
        return $paymentPage;
    }

    public function editUserAddress(): UserCheckout
    {
        $I = $this->user;
        $I->click($this->editBillingAddress);
        $userPage = new UserCheckout($I);
        $I->waitForElement($userPage->breadCrumb);
        return $userPage;
    }

    public function editPaymentMethod(): PaymentCheckout
    {
        $I = $this->user;
        $I->click($this->previousStepLink);
        $paymentPage = new PaymentCheckout($I);
        $I->waitForElement($paymentPage->breadCrumb);
        return $paymentPage;
    }

    public function validatePaymentMethod(string $paymentMethod): self
    {
        $this->user->see($paymentMethod, $this->paymentMethod);
        return $this;
    }

    public function validateShippingMethod(string $shippingMethod): self
    {
        $this->user->see($shippingMethod, $this->shippingMethod);
        return $this;
    }

    public function editShippingMethod(): PaymentCheckout
    {
        $I = $this->user;
        $I->retryClick($this->editShippingMethod);
        $paymentPage = new PaymentCheckout($I);
        $I->waitForElement($paymentPage->breadCrumb);
        return $paymentPage;
    }

    public function validateCoupon(string $couponId, string $couponDiscount): self
    {
        $I = $this->user;
        $informationText = sprintf(
            '%s (%s %s) %s',
            Translator::translate('COUPON'),
            Translator::translate('NUMBER'),
            $couponId,
            $couponDiscount
        );
        $I->see($informationText, $this->couponInformation);
        return $this;
    }

    public function validateVat(array $vatInformation): self
    {
        $I = $this->user;
        $position = 2;
        foreach ($vatInformation as $vatAmount) {
            $I->see($vatAmount, sprintf($this->basketSummaryVat, $position));
            $position++;
        }
        return $this;
    }

    public function validateTotalPrice(array $priceInformation): self
    {
        $I = $this->user;
        $I->see($priceInformation['net'], $this->basketSummaryNet);
        $I->see($priceInformation['gross'], $this->basketSummaryGross);
        $I->see($priceInformation['shipping'], $this->basketShippingGross);
        $I->see($priceInformation['payment'], $this->basketPaymentGross);
        $I->see($priceInformation['total'], $this->basketTotalPrice);
        return $this;
    }

    public function validateWrappingPrice(string $priceInformation): self
    {
        $this->user->see($priceInformation, $this->basketWrappingGross);
        return $this;
    }

    public function validateGiftCardPrice(string $priceInformation): self
    {
        $this->user->see($priceInformation, $this->basketGiftCardGross);
        return $this;
    }

    /**
     * $basketProducts[] = ['id' => productId,
     *                   'title' => productTitle,
     *                   'amount' => productAmount,
     *                   'totalPrice' => productTotalPrice]
     */
    public function validateOrderItems(array $basketProducts): self
    {
        $I = $this->user;
        foreach ($basketProducts as $key => $basketProduct) {
            $itemPosition = (string)++$key;
            $I->see(
                sprintf('%s %s', Translator::translate('PRODUCT_NO'), $basketProduct['id']),
                sprintf($this->basketItemId, $itemPosition)
            );
            $I->see($basketProduct['title'], sprintf($this->basketItemTitle, $itemPosition));
            $I->see((string)$basketProduct['totalPrice'], sprintf($this->basketItemTotalPrice, $itemPosition));
            $I->see((string)$basketProduct['amount'], sprintf($this->basketItemAmount, $itemPosition));
        }
        return $this;
    }

    /**
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
     */
    public function validateUserBillingAddress(array $userBillAddress): self
    {
        $I = $this->user;
        $addressInfo = $this->convertBillInformationIntoString($userBillAddress);
        $I->assertEquals($I->clearString($addressInfo), $I->clearString($I->grabTextFrom($this->billingAddress)));
        return $this;
    }

    /**
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
     */
    public function validateUserDeliveryAddress(array $userDelAddress): self
    {
        $I = $this->user;
        $addressInfo = $this->convertDeliveryAddressIntoString($userDelAddress);
        $I->assertEquals($I->clearString($addressInfo), $I->clearString($I->grabTextFrom($this->deliveryAddress)));
        return $this;
    }

    public function validateRemarkText(string $userRemarkText): self
    {
        $I = $this->user;
        $I->see(Translator::translate('WHAT_I_WANTED_TO_SAY'), $this->userRemarkHeader);
        $I->see($userRemarkText, $this->userRemark);
        return $this;
    }

    private function convertBillInformationIntoString(array $userAddress): string
    {
        $transformedAddress = $this->convertAddressArrayIntoString($userAddress);
        $transformedAddress .= Translator::translate('EMAIL') . ' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'userLoginNameField');
        $transformedAddress .= Translator::translate('PHONE') . ' ';
        $transformedAddress .= $this->getAddressElement($userAddress, 'fonNr');
        $transformedAddress .= Translator::translate('FAX') . ' ';
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
        return (isset($address[$element]) && $address[$element]) ? $label . $address[$element] . ' ' : '';
    }
}
