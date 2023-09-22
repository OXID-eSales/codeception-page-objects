<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Account\Component\UserLogin;
use OxidEsales\Codeception\Page\Details\ProductDetails;
use OxidEsales\Codeception\Page\Page;

class UserOrderHistory extends Page
{
    use UserLogin;

    public string $URL = '/en/order-history/';
    private string $pageHeader = '//h3[contains(@class, "page-header")]';
    private string $orderStatus = '//span[@id="accOrderStatus_%s"]';
    private string $orderNumber = '//span[@id="accOrderNo_%s"]';
    private string $shipmentTo = '//span[@id="accOrderName_%s"]';
    private string $orderAmount = '//li[@id="accOrderAmount_%s_%s"]';
    private string $orderAmountLink = '//a[@id="accOrderLink_%s_%s"]';

    public function seePageHeader(): self
    {
        $I = $this->user;
        $I->see(Translator::translate('ORDER_HISTORY'), $this->pageHeader);

        return $this;
    }

    public function seeOrder(array $orderInformation): self
    {
        $status = $orderInformation['status'];
        $name = $orderInformation['name'];
        $orderNumber = $orderInformation['orderNumber'];
        $itemNumber = $orderInformation['itemNumber'];
        $amount = $orderInformation['amount'];
        $product = $orderInformation['product'];

        $I = $this->user;
        $I->see($status, sprintf($this->orderStatus, $orderNumber));
        $I->see($name, sprintf($this->shipmentTo, $orderNumber));
        $I->see($amount, sprintf($this->orderAmount, $orderNumber, $itemNumber));
        $I->see($product, sprintf($this->orderAmountLink, $orderNumber, $itemNumber));

        return $this;
    }

    public function openProduct(array $orderInformation): ProductDetails
    {
        $I = $this->user;

        $orderNumber = $orderInformation['orderNumber'];
        $itemNumber = $orderInformation['itemNumber'];
        $I->click(sprintf($this->orderAmountLink, $orderNumber, $itemNumber));

        return new ProductDetails($I);
    }
}
