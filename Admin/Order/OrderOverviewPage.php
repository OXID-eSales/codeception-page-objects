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

    public function seeOrderProductLabel(string $label, int $product): static
    {
        $I = $this->user;
        $I->see(
            sprintf('%s: %s', Translator::translate('GENERAL_LABEL'), $label),
            sprintf($this->orderProductLabel, $product)
        );
        return $this;
    }

    public function dontSeeOrderProductHasLabel(int $product): static
    {
        $I = $this->user;
        $I->dontSeeElement(
            sprintf($this->orderProductLabel, $product)
        );
        return $this;
    }

    public function shipOrderWithEmail(): static
    {
        $I = $this->user;

        $I->checkOption($this->orderSendMailCheckbox);
        $I->submitForm($this->shipForm, []);

        // waiting for shipment status to be changed
        $I->see(Translator::translate('GENERAL_SENDON'));

        return $this;
    }
}
