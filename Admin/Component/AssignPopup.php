<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

trait AssignPopup
{
    public function openAssignPopup(string $button): void
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->clickAndWait($button);
        $I->switchToNextTab();
        $I->waitForPageLoad();
    }
}
