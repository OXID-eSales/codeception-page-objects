<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

class WelcomeStep extends SetupStep
{
    private string $allowDataCollectionInput = '#send_technical_information_to_oxid_checkbox';
    private string $deliveryCountrySelect = '//select[@name="country_lang"]';
    private string $shopLanguageSelect = '//select[@name="sShopLang"]';
    private string $checkUpdatesCheckbox = '#check_for_updates_ckbox';
    private string $continueButton = '#step1Submit';

    public function getWaitForStepLoadElement(): string
    {
        return $this->continueButton;
    }

    public function proceedToLicenseAndConditionsStep(): LicenseConditionsStep
    {
        $I = $this->user;
        $I->click($this->continueButton);

        return new LicenseConditionsStep($this->user);
    }

    public function seeAllowDataCollectionInput(): static
    {
        $I = $this->user;
        $I->seeElement($this->allowDataCollectionInput);

        return $this;
    }

    public function dontSeeAllowDataCollectionInput(): static
    {
        $I = $this->user;
        $I->dontSeeElement($this->allowDataCollectionInput);

        return $this;
    }

    public function selectDeliveryCountry(string $country): static
    {
        $I = $this->user;
        $I->selectOption($this->deliveryCountrySelect, $country);
        $I->seeInField($this->deliveryCountrySelect, $country);

        return $this;
    }

    public function selectShopLanguage(string $language): static
    {
        $I = $this->user;
        $I->seeElement($this->shopLanguageSelect);
        $I->selectOption($this->shopLanguageSelect, $language);
        $I->seeInField($this->shopLanguageSelect, $language);

        return $this;
    }

    public function selectCheckForUpdates(): static
    {
        $I = $this->user;
        $I->seeElement($this->checkUpdatesCheckbox);
        $I->checkOption($this->checkUpdatesCheckbox);
        $I->seeCheckboxIsChecked($this->checkUpdatesCheckbox);

        return $this;
    }
}
