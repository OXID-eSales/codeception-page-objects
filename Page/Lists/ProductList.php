<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Lists;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Component\Header\Header;
use OxidEsales\Codeception\Page\Details\ProductDetails;
use OxidEsales\Codeception\Page\Page;

use function sprintf;

class ProductList extends Page
{
    use Header;

    public string $listItemTitle = '//div[@id="productList"]/div/div[%s]//*[@class="h5 card-title"]';
    public string $listItemDescription = '//div[@id="productList"]/div/div[%s]//div[@class="short-desc"]';
    public string $listItemPrice = '//div[@id="productList"]/div/div[%s]//div[contains(@class,"price")]/span';
    public string $listItemDescriptionTypeList = '//div[@id="productList"]/div/div[%s]//div[@class="card-text"]';
    public string $listItemPriceTypeList = '#productPrice_searchList_%s';
    public string $listItemForm = '//form[@name="tobasketproductList_%s"]';
    public string $listFilter = '//select[contains(@aria-label,"%s")]';
    public string $resetListFilter = "//*[@id='resetFilter']/button";
    public string $nextListPage = '//ul[contains(@class,"pagination")]//a[@aria-label="Next"]';
    public string $previousListPage = '//ul[contains(@class,"pagination")]//a[@aria-label="Previous"]';
    public string $sortingButton = '#sort';
    public string $sortingSelection = '//a[@title="%s"]';
    public string $variantSelection = '#variantselector_productList_%s button';
    public string $itemsPerPageSelection = '//ul[@class="dropdown-menu show"]//*[contains(text(),"%s")]';
    public string $listView = '';
    public string $listViewSelection = '//a[@title="%s"]';
    public string $pageNumberSelection = '//ul[contains(@class,"pagination")]//a[contains(text(),"%s")]';
    public string $activePageNumber = '//ul[contains(@class,"pagination")]/li[contains(@class,"active")]/a[contains(text(),"%s")]';
    public string $headerTitle = 'h1';
    public string $listPageDescription = '#catDescLocator';
    public string $listItemImage = '(//div[@id="productList"]/div/div[%s]//img[contains(@class,"product-img")])[%s]';

    public function route(mixed $params): string
    {
        return $this->URL . '/index.php?' . http_build_query(['cl' => 'alist', 'cnid' => $params]);
    }

    /**
     * $pageData = ['title', 'description']
     */
    public function seePageInformation(array $pageData): static
    {
        $I = $this->user;
        $I->seeText($pageData['title'], $this->headerTitle);
        $I->seeText($pageData['description'], $this->listPageDescription);

        return $this;
    }

    /**
     * $productData = ['title', 'description', 'price']
     */
    public function seeProductData(array $productData, int $itemId = 1): static
    {
        $I = $this->user;
        $I->seeText($productData['title'], sprintf($this->listItemTitle, $itemId));
        $I->seeText($productData['description'], sprintf($this->listItemDescription, $itemId));
        $I->seeText($productData['price'], sprintf($this->listItemPrice, $itemId));

        return $this;
    }

    public function seeProductPictureAltText(string $altText, int $itemPosition = 1, int $imagePosition = 1): static
    {
        $I = $this->user;
        $I->seeElement(
            sprintf(
                '%s[@alt="%s"]',
                sprintf($this->listItemImage, $itemPosition, $imagePosition),
                $altText
            )
        );

        return $this;
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
    public function seeProductDataInDisplayTypeList(array $productData, int $itemId = 1): static
    {
        $I = $this->user;
        $I->seeText($productData['title'], sprintf($this->listItemTitle, $itemId));
        $I->seeText($productData['description'], sprintf($this->listItemDescriptionTypeList, $itemId));
        $I->seeText($productData['price'], sprintf($this->listItemPrice, $itemId));
        return $this;
    }

    /**
     * $productData = ['title']
     */
    public function dontSeeProductData(array $productData, int $itemId = 1): static
    {
        $this->user->dontSee($productData['title'], sprintf($this->listItemTitle, $itemId));
        return $this;
    }

    public function openProductDetailsPage(int $itemId): ProductDetails
    {
        $I = $this->user;
        $I->clickWithLeftButton(
            sprintf($this->listItemTitle, $itemId)
        );
        $productDetails = new ProductDetails($I);
        $I->waitForElement($productDetails->productTitle);

        return $productDetails;
    }

    public function selectFilter($attributeName, $attributeValue): static
    {
        $I = $this->user;
        $I->selectOption(
            sprintf($this->listFilter, $attributeName),
            $attributeValue
        );
        $I->waitForElement($this->resetListFilter);
        $I->waitForPageLoad();

        return $this;
    }

    public function seeSelectedFilter($attributeName, $attributeValue): static
    {
        $I = $this->user;
        $I->seeOptionIsSelected(sprintf($this->listFilter, $attributeName), $attributeValue);
        return $this;
    }

    public function dontSeeSelectedFilter($attributeName, $attributeValue): static
    {
        $I = $this->user;
        $I->dontSeeOptionIsSelected(sprintf($this->listFilter, $attributeName), $attributeValue);
        return $this;
    }

    public function openFilter(string $attributeName): static
    {
        $this->user->clickAndWait(sprintf($this->listFilter, $attributeName));

        return $this;
    }

    public function resetFilter(): static
    {
        $I = $this->user;
        $I->scrollTo($this->resetListFilter);
        $I->clickAndWait($this->resetListFilter);
        $I->waitForElementNotVisible($this->resetListFilter);

        return $this;
    }

    public function selectProductsPerPage(string $itemsPerPage): static
    {
        $I = $this->user;
        $I->clickAndWait(Translator::translate('PRODUCTS_PER_PAGE'));
        $I->clickAndWait(sprintf($this->itemsPerPageSelection, $itemsPerPage));
        $I->seeText(Translator::translate('PRODUCTS_PER_PAGE') . ' ' . $itemsPerPage);

        return $this;
    }

    public function openNextListPage(): static
    {
        $I = $this->user;
        $I->waitForElementClickable($this->nextListPage);
        $I->clickAndWait($this->nextListPage);

        return $this;
    }

    public function openPreviousListPage(): static
    {
        $I = $this->user;
        $I->waitForElementClickable($this->previousListPage);
        $I->clickAndWait($this->previousListPage);

        return $this;
    }

    public function openListPageNumber(int $pageNumber): static
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->pageNumberSelection, $pageNumber));
        $I->waitForElement(sprintf($this->activePageNumber, $pageNumber));

        return $this;
    }

    public function selectSorting(string $sortingName, string $sortingOrder = 'asc'): static
    {
        $I = $this->user;
        $I->clickAndWait($this->sortingButton);
        $sortingTypeSelection = sprintf(
            $this->sortingSelection,
            $this->getSortingElementTitle($sortingName, $sortingOrder)
        );
        $I->waitForElementClickable($sortingTypeSelection);
        $I->clickAndWait($sortingTypeSelection);

        return $this;
    }

    public function selectVariant(int $itemId, string $variantValue): ProductDetails
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->variantSelection, $itemId));
        $I->clickAndWait($variantValue);
        $I->seeText($variantValue);

        return new ProductDetails($I);
    }

    public function addProductToBasket(int $itemId): static
    {
        $I = $this->user;
        $this->user->submitForm(sprintf($this->listItemForm, $itemId), []);
        $I->waitForPageLoad();

        return $this;
    }

    public function selectListDisplayType(string $view): static
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->listViewSelection, $view));

        return $this;
    }

    /**
     * @deprecated please use openProductDetailsPage() method
     */
    public function openDetailsPage(int $itemId): ProductDetails
    {
        return $this->openProductDetailsPage($itemId);
    }

    private function getSortingOrderTranslation(string $sortingOrder): string
    {
        if ($sortingOrder === 'asc') {
            $sortingOrderTranslated = Translator::translate('DD_SORT_ASC');
        } else {
            $sortingOrderTranslated = Translator::translate('DD_SORT_DESC');
        }
        return $sortingOrderTranslated;
    }

    private function getSortingElementTitle(string $sortingName, string $sortingOrder): string
    {
        $sortingOrderTranslated = $this->getSortingOrderTranslation($sortingOrder);
        $sortingNameTranslated = Translator::translate(strtoupper($sortingName));

        return $sortingNameTranslated . ' ' . $sortingOrderTranslated;
    }
}
