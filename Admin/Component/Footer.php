<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Component;


trait Footer
{
    public $navigationInformation = '#transfer';
    public $createNewItemButton = '//div[@class="actions"]//a[@id="btn.new"]';

    /**
     * Click on new item button
     */
    public function clickCreateNewItem(): void
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->createNewItemButton);
        $I->waitForPageLoad();
        $I->waitForElement($this->navigationInformation, 10);
    }
}