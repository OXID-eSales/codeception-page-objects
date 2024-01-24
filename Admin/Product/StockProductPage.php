<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Page\Page;

class StockProductPage extends Page
{
    use ProductList;

    public string $saveButton = "//input[@name='save']";
    private $lowStockMessageOption = 'editval[oxarticles__oxlowstockactive]';
    private $lowStockMessage = 'editval[oxarticles__oxlowstocktext]';
    private $remindAmount = 'editval[oxarticles__oxremindamount]';

    public function setLowStockMessageValue(string $message): StockProductPage
    {
        $I = $this->user;
        $I->fillField($this->lowStockMessage, $message);

        return $this;
    }

    public function seeLowStockMessageValue(string $message): StockProductPage
    {
        $I = $this->user;
        $I->seeInField($this->lowStockMessage, $message);

        return $this;
    }

    public function checkLowStockMessageOption(): StockProductPage
    {
        $I = $this->user;
        $I->checkOption($this->lowStockMessageOption);

        return $this;
    }

    public function uncheckLowStockMessageOption(): StockProductPage
    {
        $I = $this->user;
        $I->uncheckOption($this->lowStockMessageOption);

        return $this;
    }

    public function seeLowStockMessageSelected(): StockProductPage
    {
        $I = $this->user;
        $I->seeCheckboxIsChecked($this->lowStockMessageOption);

        return $this;
    }

    public function dontSeeLowStockMessageSelected(): StockProductPage
    {
        $I = $this->user;
        $I->dontSeeCheckboxIsChecked($this->lowStockMessageOption);

        return $this;
    }

    public function setRemindAmountValue(float $remindAmount): StockProductPage
    {
        $I = $this->user;
        $I->fillField($this->remindAmount, $remindAmount);

        return $this;
    }

    public function seeRemindAmountValue(float $remindAmount): StockProductPage
    {
        $I = $this->user;
        $I->seeInField($this->remindAmount, (string) $remindAmount);

        return $this;
    }

    public function save(): StockProductPage
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click($this->saveButton);
        $I->waitForPageLoad();
        return $this;
    }
}
