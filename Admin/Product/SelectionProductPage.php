<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Admin\Product\Popup\AssignSelectionListsPopup;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class SelectionProductPage extends Page
{
    use ProductList;

    public $assignSelectionListButton = 'input.edittext[type="button"][value="%s"]';
    public $assignSelectionListButtonValue = 'ARTICLE_ATTRIBUTE_ASSIGNSELECTLIST';
    public $unassignedSelectionsListTitle = 'ARTICLE_ATTRIBUTE_NOSELLIST';
    public $unassignedList = '#container1';
    public $assignedList = '#container2';

    /** @return AssignSelectionListsPopup */
    public function openAssignSelectionListPopup(): AssignSelectionListsPopup
    {
        $I = $this->user;

        $assignSelectionListButtonSelector = sprintf(
            $this->assignSelectionListButton,
            Translator::translate($this->assignSelectionListButtonValue)
        );

        $I->click($assignSelectionListButtonSelector);
        $I->switchToNextTab();
        $I->maximizeWindow();

        $I->waitForText(Translator::translate($this->unassignedSelectionsListTitle));
        $I->waitForElement($this->unassignedList);
        $I->waitForElement($this->assignedList);

        return new AssignSelectionListsPopup($I);
    }
}
