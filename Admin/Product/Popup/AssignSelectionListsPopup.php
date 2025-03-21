<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product\Popup;

use OxidEsales\Codeception\Admin\Category\Popup\DragAndDropLists;
use OxidEsales\Codeception\Page\Page;

class AssignSelectionListsPopup extends Page
{
    use DragAndDropLists;

    public function assignSelectionByTitle(string $itemTitle): static
    {
        $this->searchInList1($itemTitle);
        $this->dragFromList1ToList2();

        return $this;
    }

    public function seeProductAssigned(string $itemTitle): static
    {
        $this->seeProductInAssignedList($itemTitle);

        return $this;
    }
}
