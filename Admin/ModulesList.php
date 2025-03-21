<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Component\Tabs;
use OxidEsales\Codeception\Page\Page;

use function sprintf;

class ModulesList extends Page
{
    use Tabs;

    public string $moduleInformation = '#transfer';
    public string $moduleTabSelector = "//div[@class='tabs']//a[text()='%s']";
    public string $activateModuleButton = '#module_activate';
    public string $deactivateModuleButton = '#module_deactivate';

    public function selectModule(string $moduleName): ModulesList
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->seeText($moduleName);
        $I->clickAndWait($moduleName);
        $I->selectEditFrame();
        $I->waitForElement($this->moduleInformation);

        return $this;
    }

    public function openModuleTab(string $tab): ModulesList
    {
        $this->openTab($tab);

        return $this;
    }

    public function activateModule(): ModulesList
    {
        $I = $this->user;
        $I->dontSeeElement($this->deactivateModuleButton);
        $I->seeElement($this->activateModuleButton);
        $I->clickAndWait($this->activateModuleButton);
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();
        $I->dontSeeElement($this->activateModuleButton);
        $I->waitForElementClickable($this->deactivateModuleButton);

        return $this;
    }

    public function deactivateModule(): ModulesList
    {
        $I = $this->user;
        $I->dontSeeElement($this->activateModuleButton);
        $I->seeElement($this->deactivateModuleButton);
        $I->clickAndWait($this->deactivateModuleButton);
        $I->dontSeeElement($this->deactivateModuleButton);
        $I->waitForElementClickable($this->activateModuleButton);

        return $this;
    }
}
