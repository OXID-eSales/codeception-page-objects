<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Lists\Component;

use OxidEsales\Codeception\Module\Translation\Translator;

trait ListOptions
{
    public $optionButton = '//button//*[contains(text(), "%s")]';
    
    public $sortingSelection = '//a[@title="%s"]';

    public $itemsPerPageSelection = '//div[@class="btn-group open"]//*[contains(text(),"%s")]';
    
    public $listViewSelection = '//ul[@class="dropdown-menu"]//*[contains(text(),"%s")]';

    public $nextListPage = '//ol[@id="itemsPager"]/li[@class="next"]/a';

    public $previousListPage = '//ol[@id="itemsPager"]/li[@class="prev"]/a';
    
    public $pageNumberSelection = '//ol[@id="itemsPager"]//a[contains(text(),"%s")]';

    public $activePageNumber = '//ol[@id="itemsPager"]/li[@class="active"]/a[contains(text(),"%s")]';

    /**
     * @param string $sortingName
     * @param string $sortingOrder
     *
     * @return self
     */
    public function selectSorting(string $sortingName, string $sortingOrder = 'asc'): self
    {
        $I = $this->user;
        $I->click(sprintf($this->optionButton, Translator::translate('SORT_BY')));
        $I->waitForElement(sprintf($this->sortingSelection, $this->getSortingElementTitle($sortingName, $sortingOrder)));
        $I->click(sprintf($this->sortingSelection, $this->getSortingElementTitle($sortingName, $sortingOrder)));
        $I->waitForText(Translator::translate('SORT_BY') . ': ' . Translator::translate(strtoupper($sortingName)));

        return $this;
    }

    /**
     * @param int $item
     *
     * @return self
     */
    public function selectProductsPerPage(int $item): self
    {
        $I = $this->user;
        $I->click(sprintf($this->optionButton, Translator::translate('PRODUCTS_PER_PAGE')));
        $I->waitForElementClickable(sprintf($this->itemsPerPageSelection, $item));
        $I->click(sprintf($this->itemsPerPageSelection, $item));
        $I->waitForText(Translator::translate('PRODUCTS_PER_PAGE') . ' ' . $item);

        return $this;
    }

    /**
     * @param string $view
     *
     * @return self
     */
    public function selectListDisplayType(string $view): self
    {
        $I = $this->user;
        $I->click(sprintf($this->optionButton, Translator::translate('LIST_DISPLAY_TYPE')));
        $I->waitForElementClickable(sprintf($this->listViewSelection, $view));
        $I->click(sprintf($this->listViewSelection, $view));
        $I->waitForText(Translator::translate('LIST_DISPLAY_TYPE') . ' ' . $view);

        return $this;
    }

    /**
     * @return self
     */
    public function openNextListPage(): self
    {
        $I = $this->user;
        $I->click($this->nextListPage);
        $I->waitForPageLoad();

        return $this;
    }

    /**
     * @return self
     */
    public function openPreviousListPage(): self
    {
        $I = $this->user;
        $I->click($this->previousListPage);
        $I->waitForPageLoad();

        return $this;
    }

    /**
     * @param int $pageNumber
     *
     * @return self
     */
    public function openListPageNumber(int $pageNumber): self
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
