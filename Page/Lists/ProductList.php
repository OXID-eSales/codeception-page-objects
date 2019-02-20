<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Lists;

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Details\ProductDetails;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for product list page
 * @package OxidEsales\Codeception\Page\Lists
 */
class ProductList extends Page
{
    use AccountMenu;

    public $listItemTitle = '#productList_%s';

    public $listItemDescription = '//form[@name="tobasketproductList_%s"]/div[2]/div[2]/div/div[@class="shortdesc"]';

    public $listItemPrice = '//form[@name="tobasketproductList_%s"]/div[2]/div[2]/div/div[@class="price"]/div/span[@class="lead text-nowrap"]';

    /**
     * @param mixed $param
     *
     * @return string
     */
    public function route($param)
    {
        return $this->URL.'/index.php?'.http_build_query(['cl' => 'alist', 'cnid' => $param]);
    }

    /**
     * Check if Product data is displayed correctly.
     * $productData = ['title', 'description', 'price']
     *
     * @param array $productData
     * @param int   $itemId      The position of the item in the list.
     *
     * @return $this
     */
    public function seeProductData($productData, $itemId = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf($this->listItemTitle, $itemId));
        $I->see($productData['description'], sprintf($this->listItemDescription, $itemId));
        $I->see($productData['price'], sprintf($this->listItemPrice, $itemId));
        return $this;
    }

    /**
     * @param int $itemId The position of the item in the list.
     *
     * @return ProductDetails
     */
    public function openDetailsPage($itemId)
    {
        $I = $this->user;
        $I->click(sprintf($this->listItemTitle, $itemId));
        return new ProductDetails($I);
    }
}
