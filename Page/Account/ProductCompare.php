<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Details\ProductDetails;
use OxidEsales\Codeception\Page\Page;

use function sprintf;

class ProductCompare extends Page
{
    use MiniBasket;

    // include url of current page
    public string $URL = '/en/my-product-comparison/';

    // include bread crumb of current page
    public string $breadCrumb = '.breadcrumb';

    public $headerTitle = 'h1';

    public $productTitle = '//*[contains(@class, "compare-products")]//div[contains(@class, "compare-product")][%s]//strong[@class="title"]//a';

    public $productNumber = '//*[contains(@class, "compare-products")]//div[contains(@class, "compare-product")][%s]//span[@class="identifier"]/small[2]';

    public $productPrice = '//*[contains(@class, "compare-products")]//div[contains(@class, "compare-product")][%s]//div[@class="price h5"]/span';

    public $attributeName = '//*[contains(@class, "compare-products")]//div[contains(@class, "attrib-title")][%s]';

    public $attributeValue = '//*[contains(@class, "compare-products")]//div[@class="attrib-text"][%s]';

    public $rightArrow = '#compareRight_%s';

    public $leftArrow = '#compareLeft_%s';

    public $removeButton = '#remove_cmp_%s';

    public string $productImage = '//*[contains(@class, "compare-products")]//div[contains(@class, "compare-product")][%s]//img[contains(@class,"product-img")]';

    /**
     * Checks if given product data is shown correctly:
     * ['id', 'title', 'price']
     *
     * @param array $productData
     * @param int   $position    The Item position
     *
     * @return $this
     */
    public function seeProductData(array $productData, int $position = 1): static
    {
        $I = $this->user;
        $I->seeText($productData['id'], sprintf($this->productNumber, $position));
        $I->seeText($productData['title'], sprintf($this->productTitle, $position));
        $I->seeText($productData['price'], sprintf($this->productPrice, $position));
        return $this;
    }

    public function seeProductAttributeName(string $attributeName, int $attributeId): static
    {
        $I = $this->user;
        $I->seeText($attributeName, sprintf($this->attributeName, $attributeId));

        return $this;
    }

    public function seeProductAttributeValue(string $attributeValue, int $attributeId): static
    {
        $I = $this->user;
        $I->seeText($attributeValue, sprintf($this->attributeValue, $attributeId));

        return $this;
    }

    public function openProductDetailsPage(int $id): ProductDetails
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->productTitle, $id));

        return new ProductDetails($I);
    }

    public function moveItemToRight(string $productId): static
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->rightArrow, $productId));

        return $this;
    }

    public function moveItemToLeft(string $productId): static
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->leftArrow, $productId));

        return $this;
    }

    public function removeProductFromList(string $productId): static
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->removeButton, $productId));

        return $this;
    }

    public function seeProductPictureAltText(string $altText, int $position = 1): static
    {
        $I = $this->user;
        $I->seeElement(
            sprintf(
                '%s[@alt="%s"]',
                sprintf($this->productImage, $position),
                $altText
            )
        );

        return $this;
    }
}
