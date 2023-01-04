<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

/**
 * Class ModulesList
 *
 * @package OxidEsales\Codeception\Admin
 */
class ModulesList extends \OxidEsales\Codeception\Page\Page
{
    public $moduleInformation = '#transfer';
    public $moduleTabSelector = '//div[@class="tabs"]//a[text()="%s"]';
    public $activateModuleButton = '#module_activate';
    public $deactivateModuleButton = '#module_deactivate';

    /**
     * @param string $moduleName
     *
     * @return ModulesList
     */
    public function selectModule(string $moduleName): ModulesList
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->waitForText($moduleName, 10);
        $I->click($moduleName);
        $I->selectEditFrame();
        $I->waitForElement($this->moduleInformation, 10);

        return $this;
    }

    /**
     * @param string $tab
     *
     * @return ModulesList
     */
    public function openModuleTab(string $tab): ModulesList
    {
        $I = $this->user;

        $I->selectListFrame();
        $selector = sprintf($this->moduleTabSelector, $tab);
        $I->waitForElement($selector, 10);
        $I->click($selector);
        $I->selectEditFrame();
        $I->waitForElement($this->moduleInformation, 10);

        return $this;
    }

    /**
     * @param string $tab
     *
     * @return ModulesList
     */
    public function activateModule(string $tab): ModulesList
    {
        $I = $this->user;

        $this->openModuleTab($tab);

        $I->dontSeeElement($this->deactivateModuleButton);
        $I->seeElement($this->activateModuleButton);
        $I->click($this->activateModuleButton);
        $I->waitForPageLoad();
        $I->dontSeeElement($this->activateModuleButton);
        $I->seeElement($this->deactivateModuleButton);

        return $this;
    }

    /**
     * @param string $tab
     *
     * @return ModulesList
     */
    public function deactivateModule(string $tab): ModulesList
    {
        $I = $this->user;

        $this->openModuleTab($tab);

        $I->dontSeeElement($this->activateModuleButton);
        $I->seeElement($this->deactivateModuleButton);
        $I->click($this->deactivateModuleButton);
        $I->waitForPageLoad();
        $I->dontSeeElement($this->deactivateModuleButton);
        $I->seeElement($this->activateModuleButton);

        return $this;
    }
}
