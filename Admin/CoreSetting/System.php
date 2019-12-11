<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Admin\CoreSetting\Component\Footer;
use OxidEsales\Codeception\Admin\CoreSetting\Component\ItemList;
use OxidEsales\Codeception\Admin\CoreSetting\Component\ListHeader;
use OxidEsales\Codeception\Admin\CoreSetting\Component\SettingsMenu;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class SystemTa
 *
 * @package OxidEsales\Codeception\Admin\CoreSetting
 */
class System extends Page
{
    use Footer, ListHeader, SettingsMenu, ItemList;

    public $buyableParentCheckbox = "//input[@type='checkbox' and contains(@name, 'blVariantParentBuyable')]";

    /**
     * @return System
     */
    public function openVariants(): System
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_VARIANTS'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    /**
     * @return System
     */
    public function checkParentProductAsBuyable(): System
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->checkOption($this->buyableParentCheckbox);
        $I->seeCheckboxIsChecked($this->buyableParentCheckbox);

        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->waitForPageLoad();

        return $this;
    }
}
