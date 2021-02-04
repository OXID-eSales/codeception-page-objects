<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Admin\Order\MainOrderPage;
use OxidEsales\Codeception\Admin\Order\AddressesOrderPage;
use OxidEsales\Codeception\Admin\Order\ProductsOrderPage;
use OxidEsales\Codeception\Admin\Order\DownloadsOrderPage;

/**
 * Trait OrderList
 *
 * @package OxidEsales\Codeception\Admin\Order
 */
trait OrderList
{
    public $searchForm = '#search';
    public $orderNumberInput = 'where[oxorder][oxordernr]';

    /**
     * @param int $orderNumber
     *
     * @return MainOrderPage
     */
    public function searchByOrderNumber(int $orderNumber): MainOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->submitForm($this->searchForm, [$this->orderNumberInput => $orderNumber]);

        return new MainOrderPage($I);
    }

    /**
     * @param string $field
     * @param string $value
     *
     * @return MainOrderPage
     */
    public function find(string $field, string $value): MainOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame();

        $I->click($value);

        $I->selectEditFrame();

        return new MainOrderPage($I);
    }

    /**
     * @return DownloadsOrderPage
     */
    public function openDownloadsTab(): DownloadsOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_downloads'));
        $I->selectEditFrame();

        return new DownloadsOrderPage($I);
    }

    /**
     * @return AddressesOrderPage
     */
    public function openAddressesTab(): AddressesOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_address'));
        $I->selectEditFrame();

        return new AddressesOrderPage($I);
    }

    /**
     * @return ProductsOrderPage
     */
    public function openProductsTab(): ProductsOrderPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_article'));
        $I->selectEditFrame();

        return new ProductsOrderPage($I);
    }

    /**
     * @return MainOrderPage
     */
    public function deleteOrder($columNumber = '1'): MainOrderPage
    {
        $this->executeListModifier("#del.$columNumber");

        return new MainOrderPage($this->user);
    }

    /**
     * @return MainOrderPage
     */
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
