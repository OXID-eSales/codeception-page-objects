<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use Codeception\Actor;
use OxidEsales\Codeception\Page\Page;

class SetupStep extends Page
{
    public function __construct(Actor $I)
    {
        parent::__construct($I);
        $this->waitForStepLoad();
    }

    private function waitForStepLoad(): void
    {
        $I = $this->user;
        $I->waitForElement(
            $this->getWaitForStepLoadElement()
        );
    }

    public function getWaitForStepLoadElement(): string
    {
        return 'html';
    }
}
