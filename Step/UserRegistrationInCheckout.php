<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Step;

use OxidEsales\Codeception\Page\Checkout\UserCheckout;
use OxidEsales\Codeception\Module\Translation\Translator;

class UserRegistrationInCheckout extends Step
{
    public function createRegisteredUserInCheckout(
        $userLoginData,
        $userData,
        $addressData,
        $shippingAddressData = null)
    {
        $userCheckout = $this->enterRegisteredUserData($userLoginData, $userData, $addressData);

        if ($shippingAddressData) {
            $userCheckout->openShippingAddressForm()->enterShippingAddressData($shippingAddressData);
        }

        $paymentPage = $userCheckout->goToNextStep();
        $breadCrumbName = Translator::translate("PAY");
        $paymentPage->seeOnBreadCrumb($breadCrumbName);
        return $paymentPage;
    }

    public function createNotRegisteredUserInCheckout(
        $userLogin,
        $userData,
        $addressData,
        $shippingAddressData = null)
    {
        $userCheckout = $this->enterNotRegisteredUserData($userLogin, $userData, $addressData);

        if ($shippingAddressData) {
            $userCheckout->openShippingAddressForm()->enterShippingAddressData($shippingAddressData);
        }

        $paymentPage = $userCheckout->goToNextStep();
        $breadCrumbName = Translator::translate("PAY");
        $paymentPage->seeOnBreadCrumb($breadCrumbName);
        return $paymentPage;
    }

    public function createNotValidRegisteredUserInCheckout(
        $userLoginData,
        $userData,
        $addressData,
        $shippingAddressData = null)
    {
        $I = $this->user;
        $userCheckout = $this->enterRegisteredUserData($userLoginData, $userData, $addressData);

        if ($shippingAddressData) {
            $userCheckout->openShippingAddressForm()->enterShippingAddressData($shippingAddressData);
        }

        $userCheckout = $userCheckout->tryToRegisterUser();
        $breadCrumbName = Translator::translate("ADDRESS");
        $userCheckout->seeOnBreadCrumb($breadCrumbName);
        $I->see($breadCrumbName, $userCheckout::$breadCrumb);

        return $userCheckout;
    }

    private function enterRegisteredUserData($userLoginData, $userData, $addressData)
    {
        $userCheckout = new UserCheckout($this->user);
        $userCheckout = $userCheckout->selectOptionRegisterNewAccount();

        $userCheckout->enterUserLoginData($userLoginData)
            ->enterUserData($userData)
            ->enterAddressData($addressData);
        return $userCheckout;
    }

    private function enterNotRegisteredUserData($userLogin, $userData, $addressData)
    {
        $userCheckout = new UserCheckout($this->user);
        $userCheckout = $userCheckout->selectOptionNoRegistration();

        $userCheckout->enterUserLoginName($userLogin)
            ->enterUserData($userData)
            ->enterAddressData($addressData);
        return $userCheckout;
    }
}