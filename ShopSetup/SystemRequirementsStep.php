<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use OxidEsales\Codeception\Page\Page;

class SystemRequirementsStep extends Page
{
    private string $url = '/Setup/index.php';
    private string $modRewriteElement = '//li[@id="mod_rewrite"]';
    private string $passedModRewriteElement = '//li[@id="mod_rewrite" and @class="pass"]';
    private string $failedModRewriteElement = '//li[@id="mod_rewrite" and @class="fail"]';
    private string $unicodeSupportElement = "//li[@id='unicode_support']";
    private string $gdInfo = "//li[@id='gd_info']";
    private string $serverConfigurationGroup = "//li[@class='group'][1]";
    private string $phpConfigurationGroup = "//li[@class='group'][2]";
    private string $phpExtensionGroup = "//li[@class='group'][3]";
    private string $notFitErrorMessage = "//div[@class='error-message']";
    private string $installationLanguageSelect = '//select[@name="setup_lang"]';
    private string $submitButton = '#step0Submit';

    public function openTab(): static
    {
        $I = $this->user;

        $I->amOnPage($this->url);

        return $this;
    }

    public function selectInstallationLanguage(string $lang): static
    {
        $I = $this->user;

        $I->seeElement($this->installationLanguageSelect);
        $I->selectOption($this->installationLanguageSelect, $lang);
        $I->seeInField($this->installationLanguageSelect, $lang);

        return $this;
    }

    public function clickToProceedWithSetup(): static
    {
        $I = $this->user;

        $I->seeElement($this->submitButton);
        $I->click($this->submitButton);

        return $this;
    }

    public function goToWelcomeStep(): WelcomeStep
    {
        $this->clickToProceedWithSetup();

        $welcomeStep = new WelcomeStep($this->user);
        $welcomeStep->seeDeliveryCountrySelect();

        return $welcomeStep;
    }

    public function seeRequirementGroups(): static
    {
        $this->user->seeElement($this->serverConfigurationGroup);
        $this->user->seeElement($this->phpConfigurationGroup);
        $this->user->seeElement($this->phpExtensionGroup);

        return $this;
    }

    public function seeTranslatedModules(): static
    {
        $this->user->seeElement($this->modRewriteElement);
        $this->user->seeElement($this->unicodeSupportElement);
        $this->user->seeElement($this->gdInfo);

        return $this;
    }

    public function seeModRewriteFitting(): static
    {
        $this->user->dontSeeElement($this->notFitErrorMessage);
        $this->user->seeElement($this->passedModRewriteElement);

        return $this;
    }

    public function dontSeeModRewriteFitting(): static
    {
        $this->user->seeElement($this->notFitErrorMessage);
        $this->user->seeElement($this->failedModRewriteElement);

        return $this;
    }
}
