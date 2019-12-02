<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class SystemTab
 *
 * @package OxidEsales\Codeception\Admin\CoreSetting
 */
class SystemTab extends Page
{
    public $buyableParentCheckbox = "//input[@type='checkbox' and contains(@name, 'blVariantParentBuyable')]";

    /**
     * @return SystemTab
     */
    public function openVariants(): SystemTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_VARIANTS'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    /**
     * @return SystemTab
     */
    public function checkParentProductAsBuyable(): SystemTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->selectEditFrame();
        $I->checkOption($this->buyableParentCheckbox);
        $I->seeCheckboxIsChecked($this->buyableParentCheckbox);

        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->waitForPageLoad();

        return $this;
    }
}
