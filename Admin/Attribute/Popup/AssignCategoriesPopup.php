<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Attribute\Popup;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Admin\Component\PopupManagement;

class AssignCategoriesPopup extends Page
{
    use PopupManagement;

    private string $orderUpButton = '#orderup';
    private string $orderDownButton = '#orderdown';

    public function moveUp(): self
    {
        $I = $this->user;
        $I->click($this->orderUpButton);
        $I->waitForAjax();
        return $this;
    }

    public function moveDown(): self
    {
        $I = $this->user;
        $I->click($this->orderDownButton);
        $I->waitForAjax();
        return $this;
    }
}
