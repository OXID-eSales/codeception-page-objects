<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use Codeception\Util\Locator;
use Facebook\WebDriver\WebDriverKeys;

trait PopupManagement
{
    private string $list1 = '#container1_c';
    private string $list2 = '#container2_c';
    private string $list3 = '#container3_c';
    private string $cellSelector = '%s tr .yui-dt-liner div';
    private string $rowSelector = '%s tr:nth-child(%d) .yui-dt-liner div';
    private string $searchInputFormat = '%s input[name="_%d"]';
    private string $assignButton = '#container1_btn-button';
    private string $unassignButton = '#container2_btn-button';

    public function assignToList2(string $value): self
    {
        return $this->assignItem($value, $this->list1, $this->list2);
    }

    public function assignToList1(string $value): self
    {
        return $this->assignItem($value, $this->list2, $this->list1);
    }

    public function assignAll(): self
    {
        $I = $this->user;
        $I->click($this->assignButton);
        $I->waitForAjax();
        return $this;
    }

    public function unassignAll(): self
    {
        $I = $this->user;
        $I->click($this->unassignButton);
        $I->waitForAjax();
        return $this;
    }

    public function seeInList1(string $item): self
    {
        return $this->seeItem($item, $this->list1);
    }

    public function seeInList2(string $item): self
    {
        return $this->seeItem($item, $this->list2);
    }

    public function seeInList3(string $item): self
    {
        return $this->seeItem($item, $this->list3);
    }

    public function dontSeeInList1(string $item): self
    {
        return $this->dontSeeItem($item, $this->list1);
    }

    public function dontSeeInList2(string $item): self
    {
        return $this->dontSeeItem($item, $this->list2);
    }

    public function dontSeeInList3(string $item): self
    {
        return $this->dontSeeItem($item, $this->list3);
    }

    public function selectInList2(string $item): self
    {
        return $this->selectItem($item, $this->list2);
    }

    public function selectInList3(string $item): self
    {
        return $this->selectItem($item, $this->list3);
    }

    private function seeItem(string $item, string $listId): self
    {
        $I = $this->user;
        $I->see($item, sprintf($this->cellSelector, $listId));
        return $this;
    }

    private function dontSeeItem(string $item, string $listId): self
    {
        $I = $this->user;
        $I->dontSee($item, sprintf($this->cellSelector, $listId));
        return $this;
    }

    private function selectItem(string $item, string $listId): self
    {
        $I = $this->user;
        $selector = sprintf($this->cellSelector, $listId);
        $I->click(Locator::contains($selector, $item));
        $I->waitForAjax();
        return $this;
    }

    private function assignItem(string $value, string $sourceListId, string $targetListId, int $field = 0): self
    {
        return $this->search($value, $sourceListId, $field)
            ->drag($value, $sourceListId, $targetListId)
            ->clearField($value, $sourceListId, $field);
    }

    private function search(string $value, string $listId, int $field = 0): self
    {
        $I = $this->user;
        $searchField = sprintf($this->searchInputFormat, $listId, $field);
        $I->fillField($searchField, $value);
        $I->pressKey($searchField, WebDriverKeys::ENTER);
        $I->waitForAjax();
        return $this;
    }

    private function clearField(string $value, string $listId, int $field = 0): self
    {
        $I = $this->user;
        $searchField = sprintf($this->searchInputFormat, $listId, $field);
        $I->clearField($searchField);
        $I->pressKey($searchField, WebDriverKeys::BACKSPACE);
        $I->waitForAjax();
        return $this;
    }

    private function drag(string $value, string $sourceListId, string $targetListId): self
    {
        $I = $this->user;
        $dragSource = sprintf($this->rowSelector, $sourceListId, 1);
        $I->retryDragAndDrop($dragSource, $targetListId);
        $I->waitForAjax();
        return $this;
    }
}
