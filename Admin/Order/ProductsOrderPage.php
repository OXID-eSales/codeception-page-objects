<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Page\Page;

/**
 * class ProductsOrderPage
 *
 * @package OxidEsales\Codeception\Admin\Order
 */
class ProductsOrderPage extends Page
{
    use OrderList;

    public $searchFieldInProductTab = "sSearchArtNum";
    public $searchButtonInProductTab = "//input[@name='search']";
    public $addButtonInProductTab = "add";
    public $secondProductInProductTab = "#art.2";

    public function addANewProductToTheOrder(string $articleNumber): self
    {
        $I = $this->user;

        $I->fillField($this->searchFieldInProductTab, $articleNumber);
        $I->click($this->searchButtonInProductTab);
        $I->click($this->addButtonInProductTab);

        return $this;
    }
}
