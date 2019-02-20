<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Page\Page;

/**
 * Class for payment checkout page
 * @package OxidEsales\Codeception\Page\Checkout
 */
class PaymentCheckout extends Page
{
    // include url of current page
    public $URL = 'index.php?lang=1&cl=payment';

    public $paymentMethod = '';

    //save form button
    public $nextStepButton = '#paymentNextStepBottom';

    public $previousStepButton = '.prevStep';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    /**
     * @param string $paymentMethod The id of a payment method.
     *
     * @return $this
     */
    public function selectPayment(string $paymentMethod)
    {
        $I = $this->user;
        $I->click('#payment_'.$paymentMethod);
        return $this;
    }

    /**
     * Opens next page: final order step.
     *
     * @return OrderCheckout
     */
    public function goToNextStep()
    {
        $I = $this->user;
        $I->click($this->nextStepButton);
        $I->waitForElement($this->breadCrumb);
        return new OrderCheckout($I);
    }

    /**
     * Opens previous page: user checkout.
     *
     * @return UserCheckout
     */
    public function goToPreviousStep()
    {
        $I = $this->user;
        $I->click($this->previousStepButton);
        $I->waitForElement($this->breadCrumb);
        return new UserCheckout($I);
    }
}
