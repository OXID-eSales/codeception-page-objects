<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting\Section;

use OxidEsales\Codeception\Page\Page;

class StockSettings extends Page
{
    private string $inStockDefaultMessageOption = 'confbools[blStockOnDefaultMessage]';
    private string $lowStockDefaultMessageOption = 'confbools[blStockLowDefaultMessage]';
    private string $outOfStockDefaultMessageOption = 'confbools[blStockOffDefaultMessage]';

    public function checkInStockMessageOption(): static
    {
        $I = $this->user;
        $I->checkOption($this->inStockDefaultMessageOption);

        return $this;
    }

    public function uncheckInStockMessageOption(): static
    {
        $I = $this->user;
        $I->uncheckOption($this->inStockDefaultMessageOption);

        return $this;
    }

    public function seeInStockMessageSelected(): static
    {
        $I = $this->user;
        $I->seeCheckboxIsChecked($this->inStockDefaultMessageOption);

        return $this;
    }

    public function dontSeeInStockMessageSelected(): static
    {
        $I = $this->user;
        $I->dontSeeCheckboxIsChecked($this->inStockDefaultMessageOption);

        return $this;
    }

    public function checkLowStockMessageOption(): static
    {
        $I = $this->user;
        $I->checkOption($this->lowStockDefaultMessageOption);

        return $this;
    }

    public function uncheckLowStockMessageOption(): static
    {
        $I = $this->user;
        $I->uncheckOption($this->lowStockDefaultMessageOption);

        return $this;
    }

    public function seeLowStockMessageSelected(): static
    {
        $I = $this->user;
        $I->seeCheckboxIsChecked($this->lowStockDefaultMessageOption);

        return $this;
    }

    public function dontSeeLowStockMessageSelected(): static
    {
        $I = $this->user;
        $I->dontSeeCheckboxIsChecked($this->lowStockDefaultMessageOption);

        return $this;
    }

    public function checkOutOfStockMessageOption(): static
    {
        $I = $this->user;
        $I->checkOption($this->outOfStockDefaultMessageOption);

        return $this;
    }

    public function uncheckOutOfStockMessageOption(): static
    {
        $I = $this->user;
        $I->uncheckOption($this->outOfStockDefaultMessageOption);

        return $this;
    }

    public function seeOutOfStockMessageSelected(): static
    {
        $I = $this->user;
        $I->seeCheckboxIsChecked($this->outOfStockDefaultMessageOption);

        return $this;
    }

    public function dontSeeOutOfStockMessageSelected(): static
    {
        $I = $this->user;
        $I->dontSeeCheckboxIsChecked($this->outOfStockDefaultMessageOption);

        return $this;
    }
}
