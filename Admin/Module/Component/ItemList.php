<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Module\Component;


trait ItemList
{
    public $moduleInformation = '#transfer';

    /**
     * @param string $moduleName
     *
     * @return self
     */
    public function selectModuleInList(string $moduleName): self
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->waitForText($moduleName, 10);
        $I->click($moduleName);
        $I->selectEditFrame();
        $I->waitForElement($this->moduleInformation, 10);

        return $this;
    }

}