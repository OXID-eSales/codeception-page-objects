<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Lists;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\LanguageMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Component\Header\SearchWidget;
use OxidEsales\Codeception\Page\Details\ProductDetails;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for product search page
 * @package OxidEsales\Codeception\Page\Lists
 */
class ProductSearchList extends Page
{
    use LanguageMenu, MiniBasket, AccountMenu, SearchWidget;

    public $listItemTitle = '#searchList_%s';

    public $listItemDescription = '//form[@name="tobasketsearchList_%s"]/div[2]/div[2]/div/div[@class="shortdesc"]';

    public $listItemPrice = '//form[@name="tobasketsearchList_%s"]/div[2]/div[2]/div/div[@class="price"]/div/span[@class="lead text-nowrap"]';

    public $listItemForm = '//form[@name="tobasketsearchList_%s"]';

    public $variantSelection = '#variantselector_searchList_%s button';

    public $sortingSelection = '//a[@title="%s"]';

    public $itemsPerPageSelection = '//div[@class="btn-group open"]//*[contains(text(),"%s")]';

    public $listViewSelection = '//ul[@class="dropdown-menu"]//*[contains(text(),"%s")]';

    public $nextListPage = '//ol[@id="itemsPager"]/li[@class="next"]/a';

    public $previousListPage = '//ol[@id="itemsPager"]/li[@class="prev"]/a';

    public $pageNumberSelection = '//ol[@id="itemsPager"]//a[contains(text(),"%s")]';

    public $activePageNumber = '//ol[@id="itemsPager"]/li[@class="active"]/a[contains(text(),"%s")]';

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
     * @param int $count
     *
     * @return $this
     */
    public function seeSearchCount(int $count)
    {
        $I = $this->user;
        $I->see($count . ' ' . Translator::translate('HITS_FOR'));
        return $this;
    }

    /**
     * @param int    $itemId       The position of the item in the list.
     * @param string $variantValue
     * @param string $waitForText
     *
     * @return ProductDetails
     */
    public function selectVariant(int $itemId, string $variantValue)
    {
        $I = $this->user;
        $I->click(sprintf($this->variantSelection, $itemId));
        $I->click($variantValue);
        $I->waitForText($variantValue);
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

    /**
     * @param string $sortingName
     * @param string $sortingOrder
     *
     * @return ProductSearchList
     */
    public function selectSorting(string $sortingName, string $sortingOrder = 'asc'): ProductSearchList
    {
        $I = $this->user;
        $I->click(Translator::translate('SORT_BY'));
        $I->waitForElement(sprintf($this->sortingSelection, $this->getSortingElementTitle($sortingName, $sortingOrder)));
        $I->click(sprintf($this->sortingSelection, $this->getSortingElementTitle($sortingName, $sortingOrder)));

        return $this;
    }

    /**
     * @param int $item
     *
     * @return ProductSearchList
     */
    public function selectProductsPerPage(int $item): ProductSearchList
    {
        $I = $this->user;
        $I->click(Translator::translate('PRODUCTS_PER_PAGE'));
        $I->click(sprintf($this->itemsPerPageSelection, $item));
        $I->waitForText(Translator::translate('PRODUCTS_PER_PAGE') . ' ' . $item);

        return $this;
    }

    /**
     * @param string $view
     *
     * @return ProductSearchList
     */
    public function selectListDisplayType(string $view): ProductSearchList
    {
        $I = $this->user;
        $I->click(Translator::translate('LIST_DISPLAY_TYPE'));
        $I->click(sprintf($this->listViewSelection, $view));
        $I->waitForText(Translator::translate('LIST_DISPLAY_TYPE') . ' ' . $view);

        return $this;
    }

    /**
     * @return ProductSearchList
     */
    public function openNextListPage(): ProductSearchList
    {
        $I = $this->user;
        $I->click($this->nextListPage);
        $I->waitForPageLoad();

        return $this;
    }

    /**
     * @return ProductSearchList
     */
    public function openPreviousListPage(): ProductSearchList
    {
        $I = $this->user;
        $I->click($this->previousListPage);
        $I->waitForPageLoad();

        return $this;
    }

    /**
     * @param int $pageNumber
     *
     * @return ProductSearchList
     */
    public function openListPageNumber(int $pageNumber): ProductSearchList
    {
        $I = $this->user;
        $I->click(sprintf($this->pageNumberSelection, $pageNumber));
        $I->waitForElement(sprintf($this->activePageNumber, $pageNumber));

        return $this;
    }

    /**
     * @param string $sortingOrder
     *
     * @return string
     */
    private function getSortingOrderTranslation($sortingOrder) : string
    {
        if ($sortingOrder === 'asc') {
            $sortingOrderTranslated = Translator::translate('DD_SORT_ASC');
        } else {
            $sortingOrderTranslated = Translator::translate('DD_SORT_DESC');
        }
        return $sortingOrderTranslated;
    }

    /**
     * @param string $sortingName
     * @param string $sortingOrder
     *
     * @return string
     */
    private function getSortingElementTitle(string $sortingName, string $sortingOrder) : string
    {
        $sortingOrderTranslated = $this->getSortingOrderTranslation($sortingOrder);
        $sortingNameTranslated = Translator::translate(strtoupper($sortingName));

        return $sortingNameTranslated . ' ' . $sortingOrderTranslated;
    }
}
