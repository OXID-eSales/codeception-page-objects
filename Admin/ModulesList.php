<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

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
}
