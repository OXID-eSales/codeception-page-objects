<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Lists;

use OxidEsales\Codeception\Page\Component\Header\LanguageMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Details\ProductDetails;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for product search page
 * @package OxidEsales\Codeception\Page\Lists
 */
class ProductSearchList extends Page
{
    use LanguageMenu, MiniBasket;

    public $listItemTitle = '#searchList_%s';

    public $listItemDescription = '//form[@name="tobasketsearchList_%s"]/div[2]/div[2]/div/div[@class="shortdesc"]';

    public $listItemPrice = '//form[@name="tobasketsearchList_%s"]/div[2]/div[2]/div/div[@class="price"]/div/span[@class="lead text-nowrap"]';

    public $listItemForm = '//form[@name="tobasketsearchList_%s"]';

    public $variantSelection = '#variantselector_searchList_%s button';

    /**
     * @param mixed $param
     *
     * @return string
     */
    public function route($param)
    {
        return $this->URL.'/index.php?'.http_build_query(['cl' => 'search', 'searchparam' => $param]);
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
    public function seeProductData(array $productData, int $itemId = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf($this->listItemTitle, $itemId));
        $I->see($productData['description'], sprintf($this->listItemDescription, $itemId));
        $I->see($productData['price'], sprintf($this->listItemPrice, $itemId));
        return $this;
    }

    /**
     * @param int    $itemId       The position of the item in the list.
     * @param string $variantValue
     * @param string $waitForText
     *
     * @return ProductDetails
     */
    public function selectVariant(int $itemId, string $variantValue, string $waitForText = '')
    {
        $I = $this->user;
        $I->click(sprintf($this->variantSelection, $itemId));
        $I->click($variantValue);
        //wait for JS to finish
        $I->waitForJS("return $.active == 0;",10);
        return new ProductDetails($I);
    }

    /**
     * @param int $itemId The position of the item in the list.
     *
     * @return ProductDetails
     */
    public function openProductDetailsPage(int $itemId)
    {
        $I = $this->user;
        $I->click(sprintf($this->listItemTitle, $itemId));
        return new ProductDetails($I);
    }

    /**
     * @param int $itemId The position of the item in the list.
     *
     * @return ProductSearchList
     */
    public function addProductToBasket(int $itemId): ProductSearchList
    {
        $I = $this->user;
        $I->submitForm(sprintf($this->listItemForm, $itemId), []);

        return $this;
    }
}
