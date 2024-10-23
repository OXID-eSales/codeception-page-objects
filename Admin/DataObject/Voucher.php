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
    private string $voucherAmount;

    public function getVoucherNr(): string
    {
        return $this->voucherNr;
    }

    public function setVoucherNr(string $voucherNr): void
    {
        $this->voucherNr = $voucherNr;
    }

    public function getVoucherAmount(): string
    {
        return $this->voucherAmount;
    }

    public function setVoucherAmount(string $voucherAmount): void
    {
        $this->voucherAmount = $voucherAmount;
    }
}
