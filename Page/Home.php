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
    public string $openManufacturerList = '//div[@class="top-brands my-5"]/div/div[%s]';

    public function openManufacturerFromStarPage(string $manufacturerTitle, int $position = 1): ProductList
    {
        return $this->openManufacturerPage($manufacturerTitle);
    }
}
