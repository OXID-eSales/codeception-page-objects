<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Admin\Component\DataTable;
use OxidEsales\Codeception\Admin\Component\Tabs;
use OxidEsales\Codeception\Module\Translation\Translator;

trait OrderList
{
    use DataTable;
    use Tabs;

    private string $searchForm = '#search';
    private string $orderNumberInput = 'where[oxorder][oxordernr]';
    private string $orderBillingLastNameInput = 'where[oxorder][oxbilllname]';

    public function findByOrderNumber(string $orderNumber): OrderOverviewPage
    {
        $this->filterRows('oxorder', 'oxordernr', $orderNumber);
        $this->selectFirstRow();

        return new OrderOverviewPage($this->user);
    }

    public function openDownloadsTab(): DownloadsOrderPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclorder_downloads'));

        return new DownloadsOrderPage($I);
    }

    public function openAddressesTab(): AddressesOrderPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclorder_address'));

        return new AddressesOrderPage($I);
    }

    public function openProductsTab(): ProductsOrderPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclorder_article'));

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
        $I->waitForElementClickable($modifierId);
        $I->openAlert($modifierId);
        $I->acceptPopup();
        $I->selectListFrame();
        $I->waitForDocumentReadyState();
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();
    }
}
