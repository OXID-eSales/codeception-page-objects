<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product\Popup;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class AssignSelectionLists extends Page
{
    public $unassignedSelectionsListTitle = 'ARTICLE_ATTRIBUTE_NOSELLIST';
    public $unassignedList = '#container1';
    public $assignedList = '#container2';
    public $titleFilter = 'input[name="_0"]';
    public $firstRow = '.yui-dt-data tr.yui-dt-first';

    /**
     * @param string $itemTitle
     * @return $this
     */
    public function assignSelectionByTitle(string $itemTitle): self
    {
        $I = $this->user;
        $I->fillField("$this->unassignedList $this->titleFilter", $itemTitle);
        $I->pressKey("$this->unassignedList $this->titleFilter", \WebDriverKeys::ENTER);
        $I->waitForText($itemTitle, null, "$this->unassignedList $this->firstRow");
        $I->dragAndDrop("$this->unassignedList $this->firstRow", $this->assignedList);
        $I->waitForText($itemTitle, null, $this->assignedList);
        return $this;
    }

    /** @return $this */
    public function waitForTab(): self
    {
        $I = $this->user;
        $I->waitForText(Translator::translate($this->unassignedSelectionsListTitle));
        $I->waitForElement($this->unassignedList);
        $I->waitForElement($this->assignedList);
        return $this;
    }

    /** @param string $value */
    public function seeInAssignedList(string $value): void
    {
        $I = $this->user;
        $I->see($value, $this->assignedList);
    }
}
