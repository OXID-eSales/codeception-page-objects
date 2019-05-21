<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Page\Details\ProductDetails;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class for my-product-comparison page
 * @package OxidEsales\Codeception\Page\Account
 */
class ProductCompare extends Page
{
    use MiniBasket;

    // include url of current page
    public $URL = '/en/my-product-comparison/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $headerTitle = 'h1';

    public $productTitle = '//tr[@class="products"]/td[%s]/div[2]/strong/a';

    public $productNumber = '//tr[@class="products"]/td[%s]/div[2]/span';

    public $productPrice = '//tr[@class="products"]/td[%s]/div[2]/form[1]/div[2]/div[1]/span[1]';

    public $attributeName = '//div[@id="compareLandscape"]/table/tbody/tr[%s]/th';

    public $attributeValue = '//div[@id="compareLandscape"]/table/tbody/tr[%s]/td[%s]';

    public $rightArrow = '#compareRight_%s';

    public $leftArrow = '#compareLeft_%s';

    public $removeButton = '#remove_cmp_%s';

    /**
     * Checks if given product data is shown correctly:
     * ['id', 'title', 'price']
     *
     * @param array $productData
     * @param int   $position    The Item position
     *
     * @return $this
     */
    public function seeProductData(array $productData, int $position = 1)
    {
        $I = $this->user;
        $I->see(Translator::translate('PRODUCT_NO').': '.$productData['id'], sprintf($this->productNumber, $position));
        $I->see($productData['title'], sprintf($this->productTitle, $position));
        // TODO: uncomment
        //$I->see($productData['price'], sprintf($this->productPrice, $id));
        return $this;
    }

    /**
     * Check product information
     *
     * @param string $attributeName
     * @param int    $attributeId
     *
     * @return $this
     */
    public function seeProductAttributeName(string $attributeName, int $attributeId)
    {
        $I = $this->user;
        $I->see($attributeName, sprintf($this->attributeName, ($attributeId+1)));
        return $this;
    }

    /**
     * Check product information
     *
     * @param string $attributeValue
     * @param int    $attributeId
     * @param int    $position       The Item position
     *
     * @return $this
     */
    public function seeProductAttributeValue(string $attributeValue, int $attributeId, int $position)
    {
        $I = $this->user;
        $I->see($attributeValue, sprintf($this->attributeValue, ($attributeId+1), $position));
        return $this;
    }

    /**
     * Opens details page
     *
     * @param int $id
     *
     * @return ProductDetails
     */
    public function openProductDetailsPage(int $id)
    {
        $I = $this->user;
        $I->click(sprintf($this->productTitle, $id));
        return new ProductDetails($I);
    }

    /**
     * Moves selected product to the right.
     *
     * @param string $productId
     *
     * @return $this
     */
    public function moveItemToRight(string $productId)
    {
        $I = $this->user;
        $I->click(sprintf($this->rightArrow, $productId));
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * Moves selected product to the left.
     *
     * @param string $productId
     *
     * @return $this
     */
    public function moveItemToLeft(string $productId)
    {
        $I = $this->user;
        $I->click(sprintf($this->leftArrow, $productId));
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * Removes selected product from the list.
     *
     * @param string $productId
     *
     * @return $this
     */
    public function removeProductFromList(string $productId)
    {
        $I = $this->user;
        $I->click(sprintf($this->removeButton, $productId));
        $I->waitForPageLoad();
        return $this;
    }
}
