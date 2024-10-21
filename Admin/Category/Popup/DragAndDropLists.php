<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category\Popup;

use Facebook\WebDriver\WebDriverKeys;

trait DragAndDropLists
{
    private string $list1 = '#container1';
    private string $list2 = '#container2';
    private string $artNrSearchInput = 'input[name="_0"]';
    private string $firstListItem = '.yui-dt-data tr.yui-dt-first';
    private string $assignAllButton = '#container1_btn';
    private string $unassignAllButton = '#container2_btn';

    public function dragFromList1ToList2(): static
    {
        $I = $this->user;
        $I->retryDragAndDrop("$this->list1 $this->firstListItem", $this->list2);
        $I->waitForAjax();
        return $this;
    }

    public function dragFromList2ToList1(): static
    {
        $I = $this->user;
        $I->retryDragAndDrop("$this->list2 $this->firstListItem", $this->list1);
        $I->waitForAjax();
        return $this;
    }

    public function searchInList1(string $value): static
    {
        $I = $this->user;
        $I->fillField("$this->list1 $this->artNrSearchInput", $value);
        $I->pressKey("$this->list1 $this->artNrSearchInput", WebDriverKeys::ENTER);
        $I->waitForAjax();
        return $this;
    }

    public function searchInList2(string $value): static
    {
        $I = $this->user;
        $I->fillField("$this->list2 $this->artNrSearchInput", $value);
        $I->pressKey("$this->list2 $this->artNrSearchInput", WebDriverKeys::ENTER);
        $I->waitForAjax();
        return $this;
    }

    private function clearSearch(string $listSelector): static
    {
        $I = $this->user;
        $searchField = "$listSelector $this->artNrSearchInput";
        $I->clearField($searchField);
        $I->click($searchField);
        $I->pressKey($searchField, WebDriverKeys::BACKSPACE);
        $I->waitForAjax();
        return $this;
    }

    public function seeProductInUnassignedList(string $artNr): static
    {
        $I = $this->user;
        $I->see($artNr, $this->list1);
        return $this;
    }

    public function dontSeeProductInUnassignedList(string $artNr): static
    {
        $I = $this->user;
        $I->dontSee($artNr, $this->list1);
        return $this;
    }

    public function seeProductInAssignedList(string $artNr): static
    {
        $I = $this->user;
        $I->see($artNr, $this->list2);
        return $this;
    }

    public function dontSeeProductInAssignedList(string $artNr): static
    {
        $I = $this->user;
        $I->dontSee($artNr, $this->list2);
        return $this;
    }

    public function assignProductByArtNr(string $artNr): static
    {
        $this->searchInList1($artNr);
        $this->dragFromList1ToList2();
        $this->clearSearch($this->list1);
        return $this;
    }

    public function unassignProductByArtNr(string $artNr): static
    {
        $this->searchInList2($artNr);
        $this->dragFromList2ToList1();
        $this->clearSearch($this->list2);
        return $this;
    }

    public function assignAllProducts(): static
    {
        $I = $this->user;
        $I->click($this->assignAllButton);
        $I->waitForAjax();
        return $this;
    }

    public function unassignAllProducts(): static
    {
        $I = $this->user;
        $I->click($this->unassignAllButton);
        $I->waitForAjax();
        return $this;
    }
}
