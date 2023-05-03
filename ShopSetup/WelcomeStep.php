<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use OxidEsales\Codeception\Page\Page;

class WelcomeStep extends Page
{
    private string $url = '/Setup/index.php?istep=200';
    private string $sendTechnicalInfoButton = '#send_technical_information_to_oxid_checkbox';
    private string $deliveryCountrySelect = '//select[@name="country_lang"]';
    private string $shopLanguageSelect = '//select[@name="sShopLang"]';
    private string $checkUpdatesCheckbox = '#check_for_updates_ckbox';
    private string $submitButton = '#step1Submit';

    public function openTab(): static
    {
        $I = $this->user;

        $I->amOnPage($this->url);

        $this->seeDeliveryCountrySelect();

        return $this;
    }

    public function clickStartInstallation(): static
    {
        $I = $this->user;

        $I->seeElement($this->submitButton);
        $I->click($this->submitButton);

        return $this;
    }

    public function goToLicenseConditionStep(): LicenseConditionsStep
    {
        $this->clickStartInstallation();

        $licenseConditionStep = new LicenseConditionsStep($this->user);
        $licenseConditionStep->seeEulaText();

        return new LicenseConditionsStep($this->user);
    }

    public function seeTechnicalInfoButton(): static
    {
        $I = $this->user;

        $I->seeElement($this->sendTechnicalInfoButton);

        return $this;
    }

    public function seeDeliveryCountrySelect(): static
    {
        $I = $this->user;

        $I->waitForElement($this->deliveryCountrySelect);

        return $this;
    }

    public function dontSeeTechnicalInfoButton(): static
    {
        $I = $this->user;

        $I->dontSeeElement($this->sendTechnicalInfoButton);

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

    public function selectUpdateCheck(): static
    {
        $I = $this->user;

        $I->seeElement($this->checkUpdatesCheckbox);
        $I->checkOption($this->checkUpdatesCheckbox);
        $I->seeCheckboxIsChecked($this->checkUpdatesCheckbox);

        return $this;
    }
}
