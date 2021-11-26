<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

/**
 * Class SettingsTab
 *
 * @package OxidEsales\Codeception\Admin\CoreSetting
 */
class SettingsTab extends Page
{
    /**
     * @return SettingsTab
     */
    public function openDownloadableProducts(): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_SHOP_DOWNLOADABLEARTICLES'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    public function openShopFrontendDropdown(): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_SHOP_FRONTEND'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    public function openStartCategoryPopup(): StartCategoryFrontendPopup
    {
        $I = $this->user;
        $I->click("//input[@value='---']");

        $I->switchToNextTab();
        $I->waitForElementVisible(['class' => 'yui-dt-data']);

        return new StartCategoryFrontendPopup($I);
    }

    public function openAdministration(): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('SHOP_OPTIONS_GROUP_ADMINISTRATION'));
        $I->waitForPageLoad();
        return $this;
    }

    public function setAdminFormat(string $format): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectOption('confstrs[sLocalDateFormat]', $format);
        $I->seeOptionIsSelected('confstrs[sLocalDateFormat]', $format);
        $I->waitForPageLoad();
        return $this;
    }

    public function save(): SettingsTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->click('save');
        $I->waitForPageLoad();
        return $this;
    }
}
