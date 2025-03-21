<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Step;

use OxidEsales\Codeception\Page\Checkout\PaymentCheckout;
use OxidEsales\Codeception\Page\Checkout\UserCheckout;
use OxidEsales\Codeception\Module\Translation\Translator;

class UserRegistrationInCheckout extends Step
{
    public function createRegisteredUserInCheckout(
        array $userLoginData,
        array $userData,
        array $addressData,
        array $shippingAddressData = []
    ): PaymentCheckout {
        $userCheckout = $this->enterRegisteredUserData($userLoginData, $userData, $addressData);

        if (!empty($shippingAddressData)) {
            $userCheckout->openShippingAddressForm()->enterShippingAddressData($shippingAddressData);
        }

        $paymentPage = $userCheckout->goToNextStep();
        $breadCrumbName = Translator::translate("PAY");
        $paymentPage->seeOnBreadCrumb($breadCrumbName);
        return $paymentPage;
    }

    public function createNotRegisteredUserInCheckout(
        string $userLogin,
        array $userData,
        array $addressData,
        array $shippingAddressData = []
    ): PaymentCheckout {
        $userCheckout = $this->enterNotRegisteredUserData($userLogin, $userData, $addressData);

        if (!empty($shippingAddressData)) {
            $userCheckout->openShippingAddressForm()->enterShippingAddressData($shippingAddressData);
        }

        $paymentPage = $userCheckout->goToNextStep();
        $breadCrumbName = Translator::translate("PAY");
        $paymentPage->seeOnBreadCrumb($breadCrumbName);
        return $paymentPage;
    }

    public function createNotValidRegisteredUserInCheckout(
        array $userLoginData,
        array $userData,
        array $addressData,
        array $shippingAddressData = []
    ): UserCheckout {
        $I = $this->user;
        $userCheckout = $this->enterRegisteredUserData($userLoginData, $userData, $addressData);

        if (!empty($shippingAddressData)) {
            $userCheckout->openShippingAddressForm()->enterShippingAddressData($shippingAddressData);
        }

        $userCheckout = $userCheckout->clickOnRegisterUserButton();
        $breadCrumbName = Translator::translate("ADDRESS");
        $userCheckout->seeOnBreadCrumb($breadCrumbName);
        $I->seeText($breadCrumbName, $userCheckout->breadCrumb);

        return $userCheckout;
    }

    private function enterRegisteredUserData(array $userLoginData, array $userData, array $addressData): UserCheckout
    {
        return (new UserCheckout($this->user))
            ->selectOptionRegisterNewAccount()
            ->enterUserLoginData($userLoginData)
            ->enterUserData($userData)
            ->enterAddressData($addressData);
    }

    private function enterNotRegisteredUserData(string $userLogin, array $userData, array $addressData): UserCheckout
    {
        return (new UserCheckout($this->user))
            ->selectOptionNoRegistration()
            ->enterUserLoginName($userLogin)
            ->enterUserData($userData)
            ->enterAddressData($addressData);
    }
}
