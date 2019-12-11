<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Module\Component;

use OxidEsales\Codeception\Admin\Module\ModuleSettings;
use OxidEsales\Codeception\Module\Translation\Translator;

trait SettingsMenu
{
    public $moduleSettings = '//div[@class="tabs"]//a[text()="%s"]';
    public $moduleInformation = '#transfer';

    /**
     * @return ModuleSettings
     */
    public function openModuleSettings(): ModuleSettings
    {
        $I = $this->user;

        $I->selectListFrame();
        $selector = sprintf($this->moduleSettings, Translator::translate('tbclmodule_config'));
        $I->waitForElement($selector, 10);
        $I->click($selector);
        $I->selectEditFrame();
        $I->waitForElement($this->moduleInformation, 10);

        return new ModuleSettings($I);
    }
}