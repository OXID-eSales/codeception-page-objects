<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Header;

use OxidEsales\Codeception\Page\Home;
use OxidEsales\Codeception\Page\ProductList;

trait Navigation
{
    public static $homeLink = '//ul[@id="navigation"]/li[1]/a';

    /**
     * @return Home
     */
    public function openHomePage()
    {
        $I = $this->user;
        $I->click(self::$homeLink);
        return new Home($I);
    }

    /**
     * @param string $category
     *
     * @return ProductList
     */
    public function openCategoryPage($category)
    {
        $I = $this->user;
        $I->click(['link' => $category]);
        return new ProductList($I);
    }
}
