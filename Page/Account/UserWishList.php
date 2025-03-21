<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Page\Details\ProductDetails;

use function sprintf;

class UserWishList extends Page
{
    use MiniBasket;
    use AccountMenu;

    public string $URL = '/en/my-wish-list/';
    public string $breadCrumb = '.breadcrumb';
    public string $headerTitle = 'h1';
    public string $productTitle = '//div[@id="noticelistProductList"]/div/div[%s]//a';
    public string $productDescription = '//div[@id="noticelistProductList"]/div/div[%s]//div[@class="card-text"]';
    public string $productPrice = '#productPrice_noticelistProductList_%s';
    public string $basketAmount = '#amountToBasket_noticelistProductList_%s';
    public string $toBasketButton = '#toBasket_noticelistProductList_%s';
    public string $removeButton = '//button[@data-triggerform="remove_tonoticelistnoticelistProductList_%s"]';

    public function seePageOpen(): self
    {
        $this->user->seeText(Translator::translate('PAGE_TITLE_ACCOUNT_NOTICELIST'), $this->headerTitle);
        return $this;
    }

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
        $I->seeText($productData['title'], sprintf($this->productTitle, $itemPosition));
        $I->seeText($productData['description'], sprintf($this->productDescription, $itemPosition));
        $I->seeText($productData['price'], sprintf($this->productPrice, $itemPosition));
        return $this;
    }

    /**
     * @return ProductDetails
     */
    public function openProductDetailsPage(int $itemPosition)
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->productTitle, $itemPosition));
        return new ProductDetails($I);
    }

    /**
     * @return $this
     */
    public function addProductToBasket(int $itemPosition, int $amount)
    {
        $I = $this->user;
        $amountInput = sprintf($this->basketAmount, $itemPosition);
        $addButton = sprintf($this->toBasketButton, $itemPosition);
        $I->fillField($amountInput, $amount);
        $I->clickAndWait($addButton);
        $I->waitForElementClickable($addButton);

        return $this;
    }

    /**
     * @return $this
     */
    public function removeProductFromList(int $itemPosition)
    {
        $I = $this->user;
        $removeButton = sprintf($this->removeButton, $itemPosition);
        $I->clickAndWait($removeButton);
        $I->waitForElementNotVisible($removeButton);

        return $this;
    }
}
