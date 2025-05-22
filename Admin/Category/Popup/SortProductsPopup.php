<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category\Popup;

use OxidEsales\Codeception\Page\Page;

use function sprintf;

class SortProductsPopup extends Page
{
    use DragAndDropLists;

    private string $saveButton = '#saveBtn';
    private string $deleteButton = '#deleteBtn';
    private string $rowTemplate = '%s .yui-dt-data tr:nth-child(%d) .yui-dt0-col-_0 .yui-dt-liner div';
    private string $columnHeaderTemplate = '%s thead th:nth-child(%d) .yui-dt-label';

    public function seeProductInPosition(string $productId, int $position): static
    {
        $I = $this->user;
        $row = sprintf($this->rowTemplate, $this->list1, $position);
        $I->seeText(text: $productId, selector: $row);

        return $this;
    }

    public function saveSorting(): static
    {
        $I = $this->user;
        $content = $I->grabTextFrom($this->list1);
        $I->clickAndWait($this->saveButton);
        $I->waitForTextUpdate($this->list1, $content);

        return $this;
    }

    public function deleteSorting(): static
    {
        $I = $this->user;
        $content = $I->grabTextFrom($this->list1);
        $I->clickAndWait($this->deleteButton);
        $I->waitForTextUpdate($this->list1, $content);

        return $this;
    }

    public function sortByColumn(int $columnNumber): static
    {
        $I = $this->user;
        $content = $I->grabTextFrom($this->list1);
        $I->clickAndWait(
            sprintf($this->columnHeaderTemplate, $this->list1, $columnNumber)
        );
        $I->waitForTextUpdate($this->list1, $content);

        return $this;
    }
}
