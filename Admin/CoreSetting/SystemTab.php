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
    public string $buyableParentCheckbox = "//input[@type='checkbox' and contains(@name, 'blVariantParentBuyable')]";
    private string $displayVariantsCheckbox = "//input[@type='checkbox' and contains(@name, 'blVariantsSelection')]";

    public function openVariants(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->clickAndWait(Translator::translate('SHOP_OPTIONS_GROUP_VARIANTS'));
        $I->selectListFrame();
        $I->selectEditFrame();
        return $this;
    }

    /**
     * @return SystemTab
     */
    public function checkParentProductAsBuyable(): SystemTab
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->checkOption($this->buyableParentCheckbox);
        $I->clickAndWait(Translator::translate('GENERAL_SAVE'));

        return $this;
    }

    public function disableParentProductAsBuyable(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->uncheckOption($this->buyableParentCheckbox);
        $I->clickAndWait(Translator::translate('GENERAL_SAVE'));

        return $this;
    }

    public function enableVariantsInAssignmentLists(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->checkOption($this->displayVariantsCheckbox);
        $I->clickAndWait(Translator::translate('GENERAL_SAVE'));

        return $this;
    }

    public function disableVariantsInAssignmentLists(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->uncheckOption($this->displayVariantsCheckbox);
        $I->clickAndWait(Translator::translate('GENERAL_SAVE'));

        return $this;
    }
}
