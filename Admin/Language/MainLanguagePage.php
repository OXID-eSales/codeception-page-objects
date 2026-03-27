<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Language;

use OxidEsales\Codeception\Admin\Component\EditForm;
use OxidEsales\Codeception\Page\Page;

class MainLanguagePage extends Page
{
    use EditForm;
    use LanguageList;

    public string $activeCheckbox = "//input[@name='editval[active]'][@type='checkbox']";
    public string $abbreviationField = "//input[@name='editval[abbr]']";
    public string $nameField = "//input[@name='editval[desc]']";
    public string $localeSelect = "select[name='editval[locale]']";
    public string $saveButton = "//input[@name='saveArticle']";

    public function selectLocale(string $localeCode): self
    {
        $this->user->selectOption($this->localeSelect, $localeCode);

        return $this;
    }

    public function save(): self
    {
        $this->submitForm($this->saveButton);

        return $this;
    }

    public function seeLocaleSelected(string $localeLabel): self
    {
        $this->user->seeOptionIsSelected($this->localeSelect, $localeLabel);

        return $this;
    }

    public function seeLocalesAvailable(string ...$localeLabels): self
    {
        foreach ($localeLabels as $label) {
            $this->user->see($label, $this->localeSelect);
        }

        return $this;
    }
}
