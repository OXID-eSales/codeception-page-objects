<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category\Popup;

use Facebook\WebDriver\WebDriverElement;
use Facebook\WebDriver\WebDriverKeys;

use function sprintf;

trait DragAndDropLists
{
    private string $list1 = '#container1';
    private string $list2 = '#container2';
    private string $artNrSearchInput = 'input[name="_0"]';
    private string $datatableBody = 'table.yui-dt-table tbody.yui-dt-data';
    private string $datatableFirstRow = 'table.yui-dt-table tbody.yui-dt-data tr.yui-dt-first';
    private string $assignAllButton = '#container1_btn';
    private string $unassignAllButton = '#container2_btn';

    public function dragFromList1ToList2(): static
    {
        $I = $this->user;
        $content = $I->grabTextFrom($this->list2);
        $this->moveFirstRow($this->list1, $this->list2);
        $I->waitForTextUpdate($this->list2, $content);

        return $this;
    }

    public function dragFromList2ToList1(): static
    {
        $I = $this->user;
        $content = $I->grabTextFrom($this->list1);
        $this->moveFirstRow($this->list2, $this->list1);
        $I->waitForTextUpdate($this->list1, $content);

        return $this;
    }

    public function searchInList1(string $value): static
    {
        $I = $this->user;
        $searchInput = "$this->list1 $this->artNrSearchInput";
        $I->fillField($searchInput, $value);
        $I->pressKey($searchInput, WebDriverKeys::ENTER);
        $I->waitForPageLoad();
        $this->waitForElementDisplayed($this->list1 . ' tbody.yui-dt-data');

        return $this;
    }

    public function searchInList2(string $value): static
    {
        $I = $this->user;
        $searchInput = "$this->list2 $this->artNrSearchInput";
        $I->fillField($searchInput, $value);
        $I->pressKey($searchInput, WebDriverKeys::ENTER);
        $I->waitForPageLoad();
        $this->waitForElementDisplayed($this->list2 . ' tbody.yui-dt-data');

        return $this;
    }

    public function seeProductInUnassignedList(string $artNr): static
    {
        $I = $this->user;
        $I->waitForText($artNr, selector: $this->list1);
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
        $I->waitForText($artNr, selector: $this->list2);
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
        $I = $this->user;
        $this->searchInList1($artNr);
        $I->waitForText($artNr, 10, $this->list1 . ' ' . $this->datatableFirstRow);
        $content = $I->grabTextFrom($this->list2);
        $this->dragFromList1ToList2();
        $this->user->waitForText($artNr, selector: $this->list2);
        $this->clearSearch($this->list1);
        $I->waitForTextUpdate($this->list2, $content);

        return $this;
    }

    public function unassignProductByArtNr(string $artNr): static
    {
        $I = $this->user;
        $this->searchInList2($artNr);
        $I->waitForText($artNr, 10, $this->list2 . ' ' . $this->datatableFirstRow);
        $content = $I->grabTextFrom($this->list1);
        $this->dragFromList2ToList1();
        $this->user->waitForText($artNr, selector: $this->list1);
        $this->clearSearch($this->list2);
        $I->waitForTextUpdate($this->list1, $content);

        return $this;
    }

    public function assignAllProducts(): static
    {
        $I = $this->user;
        $content = $I->grabTextFrom($this->list2);
        $I->clickAndWait($this->assignAllButton);
        $I->waitForTextUpdate($this->list2, $content);

        return $this;
    }

    public function unassignAllProducts(): static
    {
        $I = $this->user;
        $content = $I->grabTextFrom($this->list2);
        $I->clickAndWait($this->unassignAllButton);
        $I->waitForTextUpdate($this->list2, $content);

        return $this;
    }

    private function moveFirstRow(string $from, string $to): void
    {
        $I = $this->user;
        $I->executeJs(
            $this->dragAndDropJs(
                sprintf('%s %s', $from, $this->datatableFirstRow),
                $to
            )
        );
        $I->waitforPageLoad();
    }

    private function clearSearch(string $listSelector): static
    {
        $I = $this->user;
        $searchInput = "$listSelector $this->artNrSearchInput";
        $I->clearField($searchInput);
        $I->clickAndWait($searchInput);
        $I->executeJS("
            const input = document.querySelector('$searchInput');
            input.dispatchEvent(new Event('input', { bubbles: true }));
        ");
        $I->waitForPageLoad();

        return $this;
    }

    private function waitForElementDisplayed(string $selector): void
    {
        $I = $this->user;
        $I->waitForElementChange($selector, function (WebDriverElement $element) {
            return $element->isDisplayed();
        });
    }

    private function dragAndDropJs (string $element, string $destination)
    {
        return sprintf("
            function triggerDnD(selectorFrom, selectorTo) {
                const dataTransfer = new DataTransfer();
                const from = document.querySelector(selectorFrom);
                const to = document.querySelector(selectorTo);

                const dragStart = new DragEvent('dragstart', { dataTransfer });
                from.dispatchEvent(dragStart);

                const dragOver = new DragEvent('dragover', { dataTransfer });
                to.dispatchEvent(dragOver);

                const drop = new DragEvent('drop', { dataTransfer });
                to.dispatchEvent(drop);

                const dragEnd = new DragEvent('dragend', { dataTransfer });
                from.dispatchEvent(dragEnd);
            }

            triggerDnD(%s, %s);
        ", json_encode($element), json_encode($destination . "_bg"));
    }
}
