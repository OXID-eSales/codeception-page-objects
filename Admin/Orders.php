<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

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
}
