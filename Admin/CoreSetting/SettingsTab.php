<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Admin\Component\AssignPopup;
use OxidEsales\Codeception\Admin\CoreSetting\Section\StockSettings;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

class SettingsTab extends Page
{
    use AssignPopup;

    public function openDownloadableProducts(): SettingsTab
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->clickAndWait(Translator::translate('SHOP_OPTIONS_GROUP_SHOP_DOWNLOADABLEARTICLES'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    public function openShopFrontendDropdown(): SettingsTab
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->clickAndWait(Translator::translate('SHOP_OPTIONS_GROUP_SHOP_FRONTEND'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    public function openStartCategoryPopup(): StartCategoryFrontendPopup
    {
        $I = $this->user;
        $this->openAssignPopup(
            "//input[@value='---']"
        );

        return new StartCategoryFrontendPopup($I);
    }

    public function openAdministration(): SettingsTab
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->clickAndWait(Translator::translate('SHOP_OPTIONS_GROUP_ADMINISTRATION'));

        return $this;
    }

    public function openStockSettings(): StockSettings
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->clickAndWait(Translator::translate('SHOP_OPTIONS_GROUP_STOCK'));

        $I->selectListFrame();
        $I->selectEditFrame();

        return new StockSettings($I);
    }

    public function openAdditionalSettings(): SettingsTab
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->clickAndWait(Translator::translate('SHOP_OPTIONS_GROUP_OTHER_SETTINGS'));
        $I->selectListFrame();
        $I->selectEditFrame();
        return $this;
    }

    public function setAdminFormat(string $format): SettingsTab
    {
        $I = $this->user;
        $I->selectOption('confstrs[sLocalDateFormat]', $format);
        $I->seeOptionIsSelected('confstrs[sLocalDateFormat]', $format);
        $I->waitForPageLoad();
        return $this;
    }

    public function save(): SettingsTab
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->clickAndWait('save');

        return $this;
    }
}
