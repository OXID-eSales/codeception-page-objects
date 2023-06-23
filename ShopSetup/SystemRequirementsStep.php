<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

class SystemRequirementsStep extends SetupStep
{
    public static string $setupStartingUrl = '/Setup/index.php';
    private string $modRewriteElement = '//li[@id="mod_rewrite"]';
    private string $passedModRewriteElement = '//li[@id="mod_rewrite" and @class="pass"]';
    private string $failedModRewriteElement = '//li[@id="mod_rewrite" and @class="fail"]';
    private string $unicodeSupportElement = "//li[@id='unicode_support']";
    private string $gdInfoElement = "//li[@id='gd_info']";
    private string $serverConfigurationGroup = "//ul[@class='req']/li[@class='group'][1]";
    private string $phpConfigurationGroup = "//ul[@class='req']/li[@class='group'][2]";
    private string $phpExtensionGroup = "//ul[@class='req']/li[@class='group'][3]";
    private string $checkFailedErrorMessage = "//div[@class='error-message']";
    private string $installationLanguageSelect = '//select[@name="setup_lang"]';
    private string $continueButton = '#step0Submit';

    public function getWaitForStepLoadElement(): string
    {
        return $this->installationLanguageSelect;
    }

    public function proceedToWelcomeStep(): WelcomeStep
    {
        $I = $this->user;
        $I->click($this->continueButton);

        return new WelcomeStep($I);
    }

    public function returnToSystemRequirementsStepIfModRewriteCheckFailed(): static
    {
        $I = $this->user;
        $I->seeElement($this->checkFailedErrorMessage);
        $I->seeElement($this->failedModRewriteElement);
        $I->dontSeeElement($this->continueButton);

        return $this;
    }

    public function selectInstallationLanguage(string $lang): static
    {
        $I = $this->user;
        $I->selectOption($this->installationLanguageSelect, $lang);

        return $this;
    }

    public function seeSystemRequirementsStatusPage(): static
    {
        $this->seeSystemRequirementGroups();
        $this->seeGroupElements();

        return $this;
    }

    public function dontSeeStatusCheckErrors(): static
    {
        $I = $this->user;
        $I->dontSeeElement($this->checkFailedErrorMessage);
        $I->seeElement($this->passedModRewriteElement);

        return $this;
    }

    private function seeSystemRequirementGroups(): static
    {
        $I = $this->user;
        $I->seeElement($this->serverConfigurationGroup);
        $I->seeElement($this->phpConfigurationGroup);
        $I->seeElement($this->phpExtensionGroup);

        return $this;
    }

    private function seeGroupElements(): static
    {
        $I = $this->user;
        $I->seeElement($this->modRewriteElement);
        $I->seeElement($this->unicodeSupportElement);
        $I->seeElement($this->gdInfoElement);

        return $this;
    }
}
