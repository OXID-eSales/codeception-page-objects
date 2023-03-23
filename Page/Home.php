<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page;

use OxidEsales\Codeception\Page\Component\Footer\Footer;
use OxidEsales\Codeception\Page\Component\Header\Header;
use OxidEsales\Codeception\Page\Lists\ProductList;

class Home extends Page
{
    use Header;
    use Footer;

    public $URL = '/';
    public string $openManufacturerList = '//div[@class="row manufacturer-list"]/div[%s]';

    public function openManufacturerFromStarPage(string $manufacturerTitle, int $position = 1): ProductList
    {
        $I = $this->user;
        $productListPage = new ProductList($I);
        $I->retryMoveMouseOver(sprintf($this->openManufacturerList, $position));
        $I->retryClick(sprintf($this->openManufacturerList, $position));
        $I->waitForPageLoad();
        return $productListPage;
    }

}
