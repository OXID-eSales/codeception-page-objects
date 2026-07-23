<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Theme;

use OxidEsales\Codeception\Page\Page;

use function sprintf;

class ThemeSettingsTab extends Page
{
    private string $settingField = 'settings[%s]';
    private string $settingCheckbox = "//input[@type='checkbox'][@name='settings[%s]']";
    private string $saveButton = 'save';

    public function seeThemeTitle(string $themeTitle): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->seeText($themeTitle);

        return $this;
    }

    public function openSettingGroup(string $groupTitle): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->clickAndWait($groupTitle);

        return $this;
    }

    public function checkBoolSetting(string $settingName): static
    {
        $I = $this->user;
        $I->checkOption($this->getCheckboxSelector($settingName));

        return $this;
    }

    public function uncheckBoolSetting(string $settingName): static
    {
        $I = $this->user;
        $I->uncheckOption($this->getCheckboxSelector($settingName));

        return $this;
    }

    public function seeBoolSettingIsChecked(string $settingName): static
    {
        $I = $this->user;
        $I->seeCheckboxIsChecked($this->getCheckboxSelector($settingName));

        return $this;
    }

    public function dontSeeBoolSettingIsChecked(string $settingName): static
    {
        $I = $this->user;
        $I->dontSeeCheckboxIsChecked($this->getCheckboxSelector($settingName));

        return $this;
    }

    public function fillSetting(string $settingName, string $value): static
    {
        $I = $this->user;
        $I->fillField($this->getFieldSelector($settingName), $value);

        return $this;
    }

    public function seeSettingValue(string $settingName, string $value): static
    {
        $I = $this->user;
        $I->seeInField($this->getFieldSelector($settingName), $value);

        return $this;
    }

    public function seeSettingIsDisabled(string $settingName): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->seeElement(
            sprintf(
                '[name="%s"][disabled]',
                $this->getFieldSelector($settingName)
            )
        );

        return $this;
    }

    public function seeEnvironmentOverrideHint(string $hint): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->see($hint);

        return $this;
    }

    public function selectSettingOption(string $settingName, string $option): static
    {
        $I = $this->user;
        $I->selectOption($this->getFieldSelector($settingName), $option);

        return $this;
    }

    public function save(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->clickAndWait($this->saveButton);

        return $this;
    }

    private function getFieldSelector(string $settingName): string
    {
        return sprintf($this->settingField, $settingName);
    }

    private function getCheckboxSelector(string $settingName): string
    {
        return sprintf($this->settingCheckbox, $settingName);
    }
}
