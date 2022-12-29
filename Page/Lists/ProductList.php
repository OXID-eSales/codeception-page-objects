<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Lists;

use OxidEsales\Codeception\Module\Translation\Translator;
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

    public $listFilter = "#filterList";

    public $resetListFilter = "//*[@id='resetFilter']/button";

    public $nextListPage = '//ol[@id="itemsPager"]/li[@class="next"]/a';

    public $previousListPage = '//ol[@id="itemsPager"]/li[@class="prev"]/a';

    public $sortingSelection = '//a[@title="%s"]';

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

    public function dontSeeProductData(array $productData, int $itemId = 1)
    {
        $I = $this->user;
        $I->dontSee($productData['title'], sprintf($this->listItemTitle, $itemId));
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

    public function openFilter(string $attributeName): self
    {
        $I = $this->user;
        $I->click($attributeName, $this->listFilter);
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
        $I->click($itemsPerPage);
        $I->waitForPageLoad();
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

    public function selectSorting(string $sortingName, string $sortingOrder = 'asc'): self
    {
        $I = $this->user;
        $I->click(Translator::translate('SORT_BY'));
        $I->waitForElement(sprintf($this->sortingSelection, $this->getSortingElementTitle($sortingName, $sortingOrder)));
        $I->click(sprintf($this->sortingSelection, $this->getSortingElementTitle($sortingName, $sortingOrder)));
        return $this;
    }

    private function getSortingOrderTranslation($sortingOrder) : string
    {
        if ($sortingOrder === 'asc') {
            $sortingOrderTranslated = Translator::translate('DD_SORT_ASC');
        } else {
            $sortingOrderTranslated = Translator::translate('DD_SORT_DESC');
        }
        return $sortingOrderTranslated;
    }

    private function getSortingElementTitle(string $sortingName, string $sortingOrder) : string
    {
        $sortingOrderTranslated = $this->getSortingOrderTranslation($sortingOrder);
        $sortingNameTranslated = Translator::translate(strtoupper($sortingName));

        return $sortingNameTranslated . ' ' . $sortingOrderTranslated;
    }
}
