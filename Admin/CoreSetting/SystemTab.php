<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class SystemTab extends Page
{
    private string $buyableParentCheckbox = "//input[@type='checkbox' and contains(@name, 'blVariantParentBuyable')]";
    private string $displayVariantsCheckbox = "//input[@type='checkbox' and contains(@name, 'blVariantsSelection')]";

    public function openVariants(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_VARIANTS'));
        $I->selectListFrame();
        $I->selectEditFrame();
        return $this;
    }

    public function enableParentProductAsBuyable(): static
    {
        return $this->setCheckboxOptionAndSave($this->buyableParentCheckbox, true);
    }

    public function disableParentProductAsBuyable(): static
    {
        return $this->setCheckboxOptionAndSave($this->buyableParentCheckbox, false);
    }

    public function enableVariantsInAssignmentLists(): static
    {
        return $this->setCheckboxOptionAndSave($this->displayVariantsCheckbox, true);
    }

    public function disableVariantsInAssignmentLists(): static
    {
        return $this->setCheckboxOptionAndSave($this->displayVariantsCheckbox, false);
    }

    private function setCheckboxOptionAndSave(string $checkboxSelector, bool $enable): static
    {
        $I = $this->user;
        $I->selectEditFrame();

        if ($enable) {
            $I->checkOption($checkboxSelector);
        } else {
            $I->uncheckOption($checkboxSelector);
        }

        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->waitForPageLoad();

        return $this;
    }
}