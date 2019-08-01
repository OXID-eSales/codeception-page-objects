<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Page\Details\ProductDetails;

/**
 * Class for my-wish-list page
 * @package OxidEsales\Codeception\Page\Account
 */
class UserWishList extends Page
{
    use MiniBasket, AccountMenu;

    // include url of current page
    public $URL = '/en/my-wish-list/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $headerTitle = 'h1';

    public $productTitle = '#noticelistProductList_%s';

    public $productDescription = '//div[@id="noticelistProductList"]/div[%s]/div/form[1]/div[2]/div[2]/div[2]';

    public $productPrice = '#productPrice_noticelistProductList_%s';

    public $basketAmount = '#amountToBasket_noticelistProductList_%s';

    public $toBasketButton = '#toBasket_noticelistProductList_%s';

    public $removeButton = '//button[@triggerform="remove_tonoticelistnoticelistProductList_%s"]';

    /**
     * Checks if given product data is shown correctly:
     * ['title', 'description', 'price']
     *
     * @param array $productData
     * @param int   $itemPosition
     *
     * @return $this
     */
    public function seeProductData(array $productData, int $itemPosition = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf($this->productTitle, $itemPosition));
        $I->see($productData['description'], sprintf($this->productDescription, $itemPosition));
        $I->see($productData['price'], sprintf($this->productPrice, $itemPosition));
        return $this;
    }

    /**
     * Opens the details page of the selected product.
     *
     * @param int $itemPosition
     *
     * @return ProductDetails
     */
    public function openProductDetailsPage(int $itemPosition)
    {
        $I = $this->user;
        $I->click(sprintf($this->productTitle, $itemPosition));
        return new ProductDetails($I);
    }

    /**
     * Adds selected product to the basket.
     *
     * @param int $itemPosition
     * @param int $amount
     *
     * @return $this
     */
    public function addProductToBasket(int $itemPosition, int $amount)
    {
        $I = $this->user;
        $I->fillField(sprintf($this->basketAmount, $itemPosition), $amount);
        $I->click(sprintf($this->toBasketButton, $itemPosition));
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * Removes selected product from the list.
     *
     * @param int $itemPosition
     *
     * @return $this
     */
    public function removeProductFromList(int $itemPosition)
    {
        $I = $this->user;
        $I->click(sprintf($this->removeButton, $itemPosition));
        $I->waitForPageLoad();
        return $this;
    }
}
