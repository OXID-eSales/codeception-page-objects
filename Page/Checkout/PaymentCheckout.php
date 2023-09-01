<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Component\Header\Navigation;
use OxidEsales\Codeception\Page\Page;

class PaymentCheckout extends Page
{
    use Navigation;

    // include url of current page
    public $URL = 'index.php?lang=1&cl=payment';

    public $paymentMethod = '';

    public $nextStepButton = '//div[@class="row"]/div[2]//button';

    public $previousStepButton = '';

    public $selectShippingButton = '//select[@name="sShipSet"]';

    public $breadCrumb = '//div[@class="step step-2 active"]';

    /**
     * @param string $paymentMethod The id of a payment method.
     *
     * @return $this
     */
    public function selectPayment(string $paymentMethod)
    {
        $I = $this->user;
        $I->click('#payment_' . $paymentMethod);
        return $this;
    }

    public function selectShipping(string $shipping)
    {
        $I = $this->user;
        $I->selectOption($this->selectShippingButton, $shipping);
        return $this;
    }

    public function goToNextStep(): OrderCheckout
    {
        $I = $this->user;
        $I->retryClick($this->nextStepButton);
        $orderCheckout = new OrderCheckout($I);
        $I->waitForElement($orderCheckout->breadCrumb);

        return $orderCheckout;
    }

    /**
     * Opens previous page: user checkout.
     *
     * @return UserCheckout
     */
    public function goToPreviousStep()
    {
        $I = $this->user;
        $I->retryClick(Translator::translate('PREVIOUS_STEP'));
        $userCheckout = new UserCheckout($I);
        $I->waitForElement($userCheckout->breadCrumb);
        return $userCheckout;
    }
}
