<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

class LicenseConditionsStep extends SetupStep
{
    private string $continueButton = '#step2Submit';
    private string $eulaRadio = '//input[@name="iEula"]';
    private string $declinedLicenseConditionsMessage =
        'Setup has been cancelled because you didn\'t accept the license conditions.';

    public function getWaitForStepLoadElement(): string
    {
        return $this->continueButton;
    }

    public function proceedToDatabaseStep(): DatabaseStep
    {
        $I = $this->user;
        $I->selectOption($this->eulaRadio, '1');
        $I->click($this->continueButton);

        return new DatabaseStep($I);
    }

    public function returnToWelcomeStepIfLicenseConditionsDeclined(): WelcomeStep
    {
        $I = $this->user;
        $I->waitForElementClickable($this->eulaRadio);
        $I->selectOption($this->eulaRadio, '0');
        $I->click($this->continueButton);

        $I->waitForText($this->declinedLicenseConditionsMessage);

        return new WelcomeStep($I);
    }
}
