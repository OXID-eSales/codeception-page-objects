<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class OrderOverviewPage extends Page
{
    use OrderList;

    private string $orderProductLabel = '.box table tbody tr:nth-of-type(%d) td:nth-of-type(6)';
    private string $shipForm = '#sendorder';
    private string $orderSendMailCheckbox = 'input[name=sendmail]';
    private string $todayOrdersCount = "//tr[td[contains(text(),'%s')]]/td[2]/b";
    private string $todayOrdersSum = "//tr[td[contains(text(),'%s')]]/td[2]";
    private string $totalOrdersCount = "//tr[td[contains(text(),'%s')]]/td[2]/b";
    private string $totalOrdersSum = "//tr[td[contains(text(),'%s')]]/td[2]";

    public function seeOrderProductLabel(string $label, int $product): self
    {
        $I = $this->user;
        $I->seeText(
            sprintf('%s: %s', Translator::translate('GENERAL_LABEL'), $label),
            sprintf($this->orderProductLabel, $product)
        );
        return $this;
    }

    public function dontSeeOrderProductHasLabel(int $product): self
    {
        $I = $this->user;
        $I->dontSeeElement(
            sprintf($this->orderProductLabel, $product)
        );
        return $this;
    }

    public function shipOrderWithEmail(): self
    {
        $I = $this->user;

        $I->checkOption($this->orderSendMailCheckbox);
        $I->submitForm($this->shipForm, []);
        $I->seeText(Translator::translate('GENERAL_SENDON'));

        return $this;
    }

    public function seeOrdersTodayCount(string $count): self
    {
        $I = $this->user;
        $I->seeText($count, sprintf($this->todayOrdersCount, Translator::translate('ORDER_OVERVIEW_ORDERAMTODAY')));
        return $this;
    }

    public function seeOrdersTodaySum(string $sum): self
    {
        $I = $this->user;
        $I->seeText($sum, sprintf($this->todayOrdersSum, Translator::translate('ORDER_OVERVIEW_ORDERSUMTODAY')));
        return $this;
    }

    public function seeTotalOrdersCount(string $count): self
    {
        $I = $this->user;
        $I->seeText($count, sprintf($this->totalOrdersCount, Translator::translate('ORDER_OVERVIEW_ORDERAMTOTAL')));
        return $this;
    }

    public function seeTotalOrdersSum(string $sum): self
    {
        $I = $this->user;
        $I->seeText($sum, sprintf($this->totalOrdersSum, Translator::translate('ORDER_OVERVIEW_ORDERSUMTOTAL')));
        return $this;
    }
}
