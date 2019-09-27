<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class ModulesList
 *
 * @package OxidEsales\Codeception\Page\Admin
 */
class ModulesList extends \OxidEsales\Codeception\Page\Page
{
    /**
     * @param string $moduleId
     */
    public function selectModule(string $moduleName)
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->waitForText($moduleName, 10);
        $I->click($moduleName);
        $I->selectEditFrame();
        $I->waitForElement("#transfer", 10);
    }

    /**
     * @param string $tab
     */
    public function openModuleTab(string $tab)
    {
        $I = $this->user;

        $I->selectListFrame();
        $selector = "//div[@class='tabs']//a[text()='{$tab}']";
        $I->waitForElement($selector, 10);
        $I->click($selector);
        $I->selectEditFrame();
        $I->waitForElement("#transfer", 10);
    }
}
