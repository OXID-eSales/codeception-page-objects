<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product\Popup;

use Facebook\WebDriver\WebDriverKeys;
use OxidEsales\Codeception\Admin\Category\Popup\DragAndDropLists;
use OxidEsales\Codeception\Page\Page;

class AssignSelectionListsPopup extends Page
{
    use DragAndDropLists;

    public $unassignedList = '#container1';
    public $assignedList = '#container2';
    public $titleFilter = 'input[name="_0"]';
    public $firstRow = '.yui-dt-data tr.yui-dt-first';

    /**
     * @param string $itemTitle
     *
     * @return $this
     */
    public function assignSelectionByTitle(string $itemTitle): self
    {
        $I = $this->user;

        $I->fillField("$this->unassignedList $this->titleFilter", $itemTitle);
        $I->pressKey("$this->unassignedList $this->titleFilter", WebDriverKeys::ENTER);
        $I->executeJS($this->dragAndDropJs("$this->unassignedList $this->firstRow", $this->assignedList));
        $I->waitForAjax();
        return $this;
    }
}
