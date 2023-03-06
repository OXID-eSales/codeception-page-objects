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

class ProductList extends Page
{
    use Header;

    public string $listItemTitle = '#productList_%s';
    public string $listItemDescription =
        '//form[@name="tobasketproductList_%s"]/div[2]/div[2]/div/div[@class="shortdesc"]';
    public string $listItemPrice =
        '//form[@name="tobasketproductList_%s"]/div[2]/div[2]/div/div[@class="price"]/div/span[@class="lead text-nowrap"]';
    public string $listItemDescriptionTypeList = '//div[@id="searchList"]/div[%s]//div[@class="description"]';
    public string $listItemPriceTypeList = '#productPrice_searchList_%s';
    public string $listItemForm = '//form[@name="tobasketproductList_%s"]';
    public string $listFilter = "#filterList";
    public string $resetListFilter = "//*[@id='resetFilter']/button";
    public string $nextListPage = '//ol[@id="itemsPager"]/li[@class="next"]/a';
    public string $previousListPage = '//ol[@id="itemsPager"]/li[@class="prev"]/a';
    public string $sortingSelection = '//a[@title="%s"]';
    public string $variantSelection = '#variantselector_productList_%s button';
    public string $itemsPerPageSelection = '//div[@class="btn-group open"]//*[contains(text(),"%s")]';
    public string $listView = '//strong[contains(text(),"%s")]';
    public string $listViewSelection = '//ul[@class="dropdown-menu"]//*[contains(text(),"%s")]';
    public string $pageNumberSelection = '//ol[@id="itemsPager"]//a[contains(text(),"%s")]';
    public string $activePageNumber = '//ol[@id="itemsPager"]/li[@class="active"]/a[contains(text(),"%s")]';
    public string $headerTitle = 'h1';
    public string $listPageDescription = '#catDescLocator';

    /**
     * @param mixed $param
     *
     * @return string
     */
    public function route($param)
    {
        return $this->URL . '/index.php?' . http_build_query(['cl' => 'alist', 'cnid' => $param]);
    }

    /**
     * $pageData = ['title', 'description']
     */
    public function seePageInformation(array $pageData): self
    {
        $I = $this->user;
        $I->see($pageData['title'], $this->headerTitle);
        $I->see($pageData['description'], $this->listPageDescription);
        return $this;
    }

    /**
     * $productData = ['title', 'description', 'price']
     */
    public function seeProductData(array $productData, int $itemId = 1): self
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf($this->listItemTitle, $itemId));
        $I->see($productData['description'], sprintf($this->listItemDescription, $itemId));
        $I->see($productData['price'], sprintf($this->listItemPrice, $itemId));
        return $this;
    }

    /**
     * $productData = ['title', 'description', 'price']
     */
    public function seeProductDataInDisplayTypeList(array $productData, int $itemId = 1): self
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf($this->listItemTitle, $itemId));
        $I->see($productData['description'], sprintf($this->listItemDescriptionTypeList, $itemId));
        $I->see($productData['price'], sprintf($this->listItemPriceTypeList, $itemId));
        return $this;
    }

    /**
     * $productData = ['title']
     */
    public function dontSeeProductData(array $productData, int $itemId = 1): self
    {
        $this->user->dontSee($productData['title'], sprintf($this->listItemTitle, $itemId));
        return $this;
    }

    public function openProductDetailsPage(int $itemId): ProductDetails
    {
        $I = $this->user;
        $I->click(sprintf($this->listItemTitle, $itemId));
        $I->waitForPageLoad();
        $productDetails = new ProductDetails($I);
        $I->waitForElement($productDetails->productTitle);
        return $productDetails;
    }

    public function selectFilter($attributeName, $attributeValue): self
    {
        $I = $this->user;
        $this->openFilter($attributeName);
        $I->waitForText($attributeValue);
        $I->click($attributeValue);
        $I->waitForPageLoad();
        $I->waitForElementVisible($this->resetListFilter);
        return $this;
    }

    public function seeSelectedFilter(string $attributeName, string $attributeValue): self
    {
        $this->user->see($attributeValue, $this->listFilter);
        return $this;
    }

    public function dontSeeSelectedFilter(string $attributeName, string $attributeValue): self
    {
        $this->openFilter($attributeName);
        $this->user->dontSee($attributeValue, $this->listFilter);
        return $this;
    }

    public function openFilter(string $attributeName): self
    {
        $this->user->click($attributeName . ':', $this->listFilter);
        return $this;
    }

    public function resetFilter(): self
    {
        $I = $this->user;
        $I->click($this->resetListFilter);
        $I->waitForElementNotVisible($this->resetListFilter);
        return $this;
    }

    public function selectProductsPerPage(string $itemsPerPage): self
    {
        $I = $this->user;
        $I->click(Translator::translate('PRODUCTS_PER_PAGE'));
        $I->click(sprintf($this->itemsPerPageSelection, $itemsPerPage));
        $I->waitForPageLoad();
        $I->waitForText(Translator::translate('PRODUCTS_PER_PAGE') . ' ' . $itemsPerPage);
        return $this;
    }

    public function openNextListPage(): self
    {
        $I = $this->user;
        $I->click($this->nextListPage);
        $I->waitForPageLoad();
        return $this;
    }

    public function openPreviousListPage(): self
    {
        $I = $this->user;
        $I->click($this->previousListPage);
        $I->waitForPageLoad();
        return $this;
    }

    public function openListPageNumber(int $pageNumber): self
    {
        $I = $this->user;
        $I->click(sprintf($this->pageNumberSelection, $pageNumber));
        $I->waitForElement(sprintf($this->activePageNumber, $pageNumber));

        return $this;
    }

    public function selectSorting(string $sortingName, string $sortingOrder = 'asc'): self
    {
        $I = $this->user;
        $I->click(Translator::translate('SORT_BY'));
        $I->waitForElement(sprintf($this->sortingSelection, $this->getSortingElementTitle($sortingName, $sortingOrder)));
        $I->click(sprintf($this->sortingSelection, $this->getSortingElementTitle($sortingName, $sortingOrder)));
        return $this;
    }

    public function selectVariant(int $itemId, string $variantValue): ProductDetails
    {
        $I = $this->user;
        $I->click(sprintf($this->variantSelection, $itemId));
        $I->click($variantValue);
        $I->waitForText($variantValue);
        return new ProductDetails($I);
    }

    public function addProductToBasket(int $itemId): self
    {
        $this->user->submitForm(sprintf($this->listItemForm, $itemId), []);
        return $this;
    }

    public function selectListDisplayType(string $view): self
    {
        $I = $this->user;
        $I->click(sprintf($this->listView, Translator::translate('LIST_DISPLAY_TYPE')));
        $I->click(sprintf($this->listViewSelection, $view));
        $I->waitForText(Translator::translate('LIST_DISPLAY_TYPE') . ' ' . $view);

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
