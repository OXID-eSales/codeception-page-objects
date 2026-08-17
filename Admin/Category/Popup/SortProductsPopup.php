<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category\Popup;

use OxidEsales\Codeception\Page\Page;

class SortProductsPopup extends Page
{
    use DragAndDropLists;

    private string $saveButton = '#saveBtn';
    private string $deleteButton = '#deleteBtn';
    private string $rowTemplate = '%s .yui-dt-data tr:nth-child(%d) td:first-child div.yui-dt-liner';
    private string $columnHeaderTemplate = '%s thead th:nth-child(%d) .yui-dt-label';

    public function seeProductInPosition(string $productId, int $position): static
    {
        $I = $this->user;
        $I->waitForText($productId, selector: sprintf($this->rowTemplate, $this->list1, $position));
        return $this;
    }

    public function saveSorting(): static
    {
        $I = $this->user;
        $I->click($this->saveButton);
        return $this;
    }

    public function deleteSorting(): static
    {
        $I = $this->user;
        $I->click($this->deleteButton);
        return $this;
    }

    public function sortByColumn(int $columnNumber): static
    {
        $I = $this->user;
        $I->click(sprintf($this->columnHeaderTemplate, $this->list1, $columnNumber));
        return $this;
    }
}
