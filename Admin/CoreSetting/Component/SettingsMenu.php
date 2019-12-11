<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\CoreSetting\Component;

use OxidEsales\Codeception\Admin\CoreSetting\System;

trait SettingsMenu
{
    /**
     * @return System
     */
    public function openSystem(): System
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate('tbclshop_system'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new System($I);
    }
}