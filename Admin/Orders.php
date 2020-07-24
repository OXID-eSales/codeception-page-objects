<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class Orders
 *
 * @package OxidEsales\Codeception\Admin
 */
class Orders extends Page
{
    public $searchForm = '#search';
    public $orderNumberInput = 'where[oxorder][oxordernr]';

    /**
     * @param int $orderNumber
     *
     * @return $this
     */
    public function searchByOrderNumber(int $orderNumber)
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->submitForm($this->searchForm, [$this->orderNumberInput => $orderNumber]);

        return $this;
    }

    /**
     * @param string $field
     * @param string $value
     */
    public function find(string $field, string $value): void
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame(); // Waits for list section to load

        $I->click($value);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();
    }

    public function openDownloadsTab(): void
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate('tbclorder_downloads'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();
    }
}
