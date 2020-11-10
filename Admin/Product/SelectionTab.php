<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Admin\Product\Popup\AssignSelectionLists;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class SelectionTab extends Page
{
    public $assignSelectionListButton = 'input.edittext[type="button"][value="%s"]';
    public $assignSelectionListButtonValue = 'ARTICLE_ATTRIBUTE_ASSIGNSELECTLIST';

    /** @return AssignSelectionLists */
    public function openAssignSelectionListPopup(): AssignSelectionLists
    {
        $I = $this->user;
        $I->click($this->getAssignSelectionListButtonSelector());
        $I->switchToNextTab();
        $I->maximizeWindow();
        return (new AssignSelectionLists($I))->waitForTab();
    }

    /** @return $this */
    public function waitForTab(): self
    {
        $I = $this->user;
        $I->waitForElementClickable($this->getAssignSelectionListButtonSelector());
        return $this;
    }

    private function getAssignSelectionListButtonSelector(): string
    {
        return sprintf(
            $this->assignSelectionListButton,
            Translator::translate($this->assignSelectionListButtonValue)
        );
    }
}
