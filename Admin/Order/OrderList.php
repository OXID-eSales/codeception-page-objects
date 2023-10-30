<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Module\Translation\Translator;

trait OrderList
{
    public string $searchForm = '#search';
    public string $orderNumberInput = 'where[oxorder][oxordernr]';
    public string $orderBillingLastNameInput = 'where[oxorder][oxbilllname]';

    public function findByOrderNumber(string $orderNumber): OrderOverviewPage
    {
        return $this->find($this->orderNumberInput, $orderNumber);
    }

    public function find(string $field, string $value): OrderOverviewPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame();

        $I->click($value);

        $I->selectEditFrame();

        return new OrderOverviewPage($I);
    }

    public function openDownloadsTab(): DownloadsOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_downloads'));
        $I->selectEditFrame();

        return new DownloadsOrderPage($I);
    }

    public function openAddressesTab(): AddressesOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_address'));
        $I->selectEditFrame();

        return new AddressesOrderPage($I);
    }

    public function openProductsTab(): ProductsOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_article'));
        $I->selectEditFrame();

        return new ProductsOrderPage($I);
    }

    public function deleteOrder($columNumber = '1'): MainOrderPage
    {
        $this->executeListModifier("#del.$columNumber");

        return new MainOrderPage($this->user);
    }

    public function cancelOrder($columNumber = '1'): MainOrderPage
    {
        $this->executeListModifier("#pau.$columNumber");

        return new MainOrderPage($this->user);
    }

    private function executeListModifier($modifierId): void
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click($modifierId);
        $I->acceptPopup();
        $I->waitForDocumentReadyState();
    }
}
