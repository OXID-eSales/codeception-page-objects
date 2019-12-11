<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Order\Component;

/**
 * Trait header
 */
trait ListHeader
{
    public $searchForm = '#search';
    public $orderNumberInput = 'where[oxorder][oxordernr]';

    /**
     * @param int $orderNumber
     *
     * @return $this
     */
    public function searchByOrderNumber(int $orderNumber): self
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->submitForm($this->searchForm, [$this->orderNumberInput => $orderNumber]);

        return $this;
    }
}
