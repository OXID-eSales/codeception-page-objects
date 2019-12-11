<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\CoreSetting\Component;


trait ItemList
{
    public $shopName = 'editval[oxshops__oxname]';

    /**
     * @param string $subShopName
     *
     * @return self
     */
    public function selectShopInList(string $subShopName): self
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click($subShopName);
        $I->selectEditFrame();
        $I->waitForText($subShopName, 30, $this->shopName);

        return $this;
    }

}