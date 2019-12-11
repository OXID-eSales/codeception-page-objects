<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\CoreSetting\Component;

use OxidEsales\Codeception\Admin\CoreSetting\Main;

/**
 * Trait footer
 */
trait Footer
{
    public $createButton = "//a[@id='btn.new']";

    /**
     * @return Main
     */
    public function openNewShopForm(): Main
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->createButton);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new Main($I);
    }
}
