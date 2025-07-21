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

class AssignCategoriesPopup extends Page
{
    use DragAndDropLists;

    public function assignCategoryByName(string $categoryName): self
    {
        $I = $this->user;

        $I->fillField("$this->list1 $this->artNrSearchInput", $categoryName);
        $I->pressKey("$this->list1 $this->artNrSearchInput", WebDriverKeys::ENTER);
        $I->waitForAjax();
        $I->executeJS($this->dragAndDropJs("$this->list1 $this->firstListItem", $this->list2));
        $I->waitForAjax();

        return $this;
    }

    public function seeCategoryInAssignedList(string $categoryName): self
    {
        $I = $this->user;
        $I->see($categoryName, $this->list2);
        return $this;
    }
}
