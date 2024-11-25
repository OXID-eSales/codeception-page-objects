<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\DataObject;

class VoucherSerie
{
    private string $title = '';
    private string $voucherType = '';

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getVoucherType(): string
    {
        return $this->voucherType;
    }

    public function setVoucherType(string $voucherType): void
    {
        $this->voucherType = $voucherType;
    }
}
