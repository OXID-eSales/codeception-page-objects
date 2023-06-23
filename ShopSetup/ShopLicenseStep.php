<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

class ShopLicenseStep extends SetupStep
{
    private string $continueButton = '#step5Submit';
    private string $licenseInput = '//input[@name="sLicence"]';
    private string $serialAddedMessage = 'License key successfully saved. Please wait ...';
    private string $wrongLicenseMessage = 'ERROR: Wrong license key!';

    public function getWaitForStepLoadElement(): string
    {
        return $this->licenseInput;
    }

    public function proceedToFinishStep(): FinishStep
    {
        $I = $this->user;
        $I->click($this->continueButton);
        $I->waitForText($this->serialAddedMessage);

        return new FinishStep($this->user);
    }

    public function retutnToShopLicenseStepIfInvalidLicense(): static
    {
        $I = $this->user;
        $I->click($this->continueButton);
        $I->waitForText($this->wrongLicenseMessage);

        return $this;
    }

    public function fillLicenseInput(string $licenceKey): static
    {
        $I = $this->user;
        $I->seeElement($this->licenseInput);
        $I->fillField($this->licenseInput, $licenceKey);

        return $this;
    }
}
