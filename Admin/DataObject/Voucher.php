<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\DataObject;

class Voucher
{
    private string $voucherNr = '';
    private string $voucherQuantity;

    public function getVoucherNr(): string
    {
        return $this->voucherNr;
    }

    public function setVoucherNr(string $voucherNr): void
    {
        $this->voucherNr = $voucherNr;
    }

    public function getVoucherQuantity(): string
    {
        return $this->voucherQuantity;
    }

    public function setVoucherQuantity(string $voucherQuantity): void
    {
        $this->voucherQuantity = $voucherQuantity;
    }
}
