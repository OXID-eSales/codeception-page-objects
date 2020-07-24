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
}
