<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Page\Page;

use function sprintf;

class Locales extends Page
{
    public string $localeManager = '#locale-manager';

    private string $addLocaleButton = '.add-row';
    private string $deleteLocaleButton = '%s//a[contains(@class, "delete")]';
    private string $fallbackSelect = "//select[@name='locales[%s][fallback]']";
    private string $localeActiveInput = "//input[@name='locales[%s][active]']";
    private string $localeActiveToggle = "%s//span[contains(@class, 'toggle-slider')]";
    private string $localeNameInput = "//input[@name='locales[%s][name]']";
    private string $localeRow = "//tr[contains(@class, 'locale-row')][.//span[contains(@class, 'locale-code') and normalize-space()='%s']]";
    private string $newLocaleField = "%s//*[@data-name='%s']";
    private string $newLocaleRow = "(//tr[contains(@class, 'new-locale-row')])[last()]";
    private string $saveButton = "//button[contains(@class, 'save-btn')]";

    public function seeLocale(string $localeCode): static
    {
        $I = $this->user;
        $I->seeElement($this->getLocaleRowSelector($localeCode));

        return $this;
    }

    public function dontSeeLocale(string $localeCode): static
    {
        $I = $this->user;
        $I->dontSeeElement($this->getLocaleRowSelector($localeCode));

        return $this;
    }

    public function fillLocaleName(string $localeCode, string $name): static
    {
        $I = $this->user;
        $localeNameInput = sprintf($this->localeNameInput, $localeCode);
        $I->clearField($localeNameInput);
        $I->fillField($localeNameInput, $name);

        return $this;
    }

    public function seeLocaleName(string $localeCode, string $name): static
    {
        $I = $this->user;
        $I->seeInField(sprintf($this->localeNameInput, $localeCode), $name);

        return $this;
    }

    public function selectLocaleFallback(string $localeCode, string $fallbackLocaleCode): static
    {
        $I = $this->user;
        $I->selectOption(sprintf($this->fallbackSelect, $localeCode), $fallbackLocaleCode);

        return $this;
    }

    public function seeLocaleFallbackSelected(string $localeCode, string $fallbackLocaleLabel): static
    {
        $I = $this->user;
        $I->seeOptionIsSelected(sprintf($this->fallbackSelect, $localeCode), $fallbackLocaleLabel);

        return $this;
    }

    public function seeLocaleFallbacksAvailable(string $localeCode, string ...$fallbackLocaleLabels): static
    {
        $I = $this->user;
        $fallbackSelect = sprintf($this->fallbackSelect, $localeCode);

        foreach ($fallbackLocaleLabels as $fallbackLocaleLabel) {
            $I->see($fallbackLocaleLabel, $fallbackSelect);
        }

        return $this;
    }

    public function toggleLocaleActive(string $localeCode): static
    {
        $I = $this->user;
        $I->click(sprintf($this->localeActiveToggle, $this->getLocaleRowSelector($localeCode)));

        return $this;
    }

    public function seeLocaleIsActive(string $localeCode): static
    {
        $I = $this->user;
        $I->seeCheckboxIsChecked(sprintf($this->localeActiveInput, $localeCode));

        return $this;
    }

    public function seeLocaleIsInactive(string $localeCode): static
    {
        $I = $this->user;
        $I->dontSeeCheckboxIsChecked(sprintf($this->localeActiveInput, $localeCode));

        return $this;
    }

    public function addLocale(
        string $localeCode,
        string $name,
        string $fallbackLocaleCode
    ): static {
        $I = $this->user;

        $I->click($this->addLocaleButton);
        $I->waitForElementVisible($this->getNewLocaleFieldSelector('code'));
        $I->fillField($this->getNewLocaleFieldSelector('code'), $localeCode);
        $I->fillField($this->getNewLocaleFieldSelector('name'), $name);
        $I->selectOption($this->getNewLocaleFieldSelector('fallback'), $fallbackLocaleCode);

        return $this;
    }

    public function deleteLocale(string $localeCode): static
    {
        $I = $this->user;
        $I->openAlert(sprintf($this->deleteLocaleButton, $this->getLocaleRowSelector($localeCode)));
        $I->acceptPopup();
        $I->selectBaseFrame();
        $I->waitForDocumentReadyState();
        $I->waitForElementVisible($this->localeManager);

        return $this;
    }

    public function save(): static
    {
        $I = $this->user;
        $I->clickAndWait($this->saveButton);
        $I->selectBaseFrame();
        $I->waitForElementVisible($this->localeManager);

        return $this;
    }

    private function getLocaleRowSelector(string $localeCode): string
    {
        return sprintf($this->localeRow, $localeCode);
    }

    private function getNewLocaleFieldSelector(string $fieldName): string
    {
        return sprintf($this->newLocaleField, $this->newLocaleRow, $fieldName);
    }
}
