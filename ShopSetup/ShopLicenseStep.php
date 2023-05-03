<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use OxidEsales\Codeception\Page\Page;

class ShopLicenseStep extends Page
{
    private string $submitButton = '#step5Submit';
    private string $licenseInput = '//input[@name="sLicence"]';
    private string $serialAddedMessage = 'License key successfully saved. Please wait ...';

    public function waitForStep(): static
    {
        $I = $this->user;

        $I->waitForElement($this->licenseInput);

        return $this;
    }

    public function fillLicenseInput(string $licenceKey): static
    {
        $I = $this->user;

        $I->seeElement($this->licenseInput);
        $I->fillField($this->licenseInput, $licenceKey);

        return $this;
    }

    public function submit(): static
    {
        $I = $this->user;

        $I->seeElement($this->licenseInput);
        $I->click($this->submitButton);

        return $this;
    }

    public function goToFinalStep(): FinishStep
    {
        $I = $this->user;

        $this->submit();
        $I->waitForText($this->serialAddedMessage);

        $finishStep = new FinishStep($this->user);
        $finishStep->seeAdminLink();

        return $finishStep;
    }
}
