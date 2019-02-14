<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Page\Header\Navigation;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Page\UserForm;

class UserCheckout extends Page
{
    use UserForm, Navigation;

    // include url of current page
    public static $URL = '';

    public static $noRegistrationOption = '//div[@id="optionNoRegistration"]/div/button';

    public static $registrationOption = '//div[@id="optionRegistration"]/div[3]/button';

    public static $openShipAddressForm = '#showShipAddress';

    public static $openBillingAddressFormButton = '#userChangeAddress';

    public static $orderRemark = '#orderRemark';

    // include bread crumb of current page
    public static $breadCrumb = '#breadcrumb';

    //save form button
    public static $nextStepButton = '#userNextStepBottom';

    public static $previousStepButton = '.prevStep';

    public static $openShipAddress = '//div[@id="shippingAddress"]/div[1]/div[1]/div[%s]/div/div[1]/button[1]';

    public static $deleteShipAddress = '//div[@id="shippingAddress"]/div[1]/div[1]/div[%s]/div/div[1]/button[2]';

    public static $selectShipAddress = '//div[@id="shippingAddress"]/div[1]/div[1]/div[%s]/div/div[2]/label';

    public static $shipAddressForm = '#shippingAddressForm';

    /**
     * @return $this
     */
    public function selectOptionNoRegistration()
    {
        $I = $this->user;
        $I->see(Translator::translate('PURCHASE_WITHOUT_REGISTRATION'));
        $I->click(self::$noRegistrationOption);
        return $this;
    }

    /**
     * @return $this
     */
    public function selectOptionRegisterNewAccount()
    {
        $I = $this->user;
        $I->click(self::$registrationOption);
        return $this;
    }

    /**
     * @return PaymentCheckout
     */
    public function goToNextStep()
    {
        $I = $this->user;
        $I->click(self::$nextStepButton);
        $I->waitForElement(self::$breadCrumb);
        return new PaymentCheckout($I);
    }

    /**
     * @return Basket
     */
    public function goToPreviousStep()
    {
        $I = $this->user;
        $I->click(self::$previousStepButton);
        $I->waitForElement(self::$breadCrumb);
        return new Basket($I);
    }

    /**
     * @return $this
     */
    public function tryToRegisterUser()
    {
        $I = $this->user;
        $I->click(self::$nextStepButton);
        $I->waitForElement(self::$breadCrumb);
        return $this;
    }

    /**
     * @return $this
     */
    public function openShippingAddressForm()
    {
        $I = $this->user;
        $I->click(self::$openShipAddressForm);
        $I->dontSeeCheckboxIsChecked(self::$openShipAddressForm);
        return $this;
    }

    /**
     * @return $this
     */
    public function openUserBillingAddressForm()
    {
        $I = $this->user;
        $I->click(self::$openBillingAddressFormButton);
        $I->waitForElementVisible(UserForm::$billCountryId);
        return $this;
    }

    /**
     * @param string $orderRemark
     *
     * @return $this
     */
    public function enterOrderRemark($orderRemark)
    {
        $I = $this->user;
        $I->fillField(self::$orderRemark, $orderRemark);
        return $this;
    }
}
