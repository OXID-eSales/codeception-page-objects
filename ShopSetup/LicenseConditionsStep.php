<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use OxidEsales\Codeception\Page\Page;

class LicenseConditionsStep extends Page
{
    private string $url = '/Setup/index.php?istep=300';
    private string $submitButton = '#step2Submit';
    private string $eulaTextarea = 'textarea.edittext';
    private string $eulaRadio = '//input[@name="iEula"]';
    private string $canceledSetupErrorMessage = 'Setup has been cancelled because you didn\'t accept the license conditions.';

    public function openTab(): static
    {
        $I = $this->user;

        $I->amOnPage($this->url);
        $this->seeEulaText();

        return $this;
    }

    public function seeEulaText(): static
    {
        $I = $this->user;

        $I->seeElement($this->eulaTextarea);

        return $this;
    }

    public function seeInstallationCanceledErrorMessage(): static
    {
        $I = $this->user;

        $I->see($this->canceledSetupErrorMessage);

        return $this;
    }

    public function acceptLicenseConditions(): static
    {
        $I = $this->user;

        $I->seeElement($this->eulaRadio);
        $I->selectOption($this->eulaRadio, '1');

        return $this;
    }

    public function doNotAcceptLicenseConditions(): static
    {
        $I = $this->user;

        $I->seeElement($this->eulaRadio);
        $I->selectOption($this->eulaRadio, '0');

        return $this;
    }

    public function submit(): static
    {
        $I = $this->user;

        $I->seeElement($this->submitButton);
        $I->click($this->submitButton);

        return $this;
    }

    public function goToDBStep(): DatabaseStep
    {
        $this->acceptLicenseConditions();
        $this->submit();

        $databaseStep = new DatabaseStep($this->user);
        $databaseStep->waitForStep();

        return $databaseStep;
    }
}
