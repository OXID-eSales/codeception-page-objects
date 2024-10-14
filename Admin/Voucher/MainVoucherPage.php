<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Voucher;

use OxidEsales\Codeception\Admin\DataObject\Voucher;
use OxidEsales\Codeception\Page\Page;

class MainVoucherPage extends Page
{
    use VoucherList;

    public string $titleInput = "//input[@name='editval[oxvoucherseries__oxserienr]']";
    public string $voucherType = "//select[@name='editval[oxvoucherseries__oxdiscounttype]']";
    public string $saveButton = "//input[@name='save']";

    public function createVoucher(Voucher $voucher)
    {
        $I = $this->user;

        $I->fillField($this->titleInput, $voucher->getTitle());
        $I->selectOption($this->voucherType, $voucher->getVoucherType());
        $I->click($this->saveButton);
        $I->waitForDocumentReadyState();

        return $this;
    }

    public function seeVoucher(Voucher $voucher): self
    {
        $I = $this->user;

        $I->seeInField($this->titleInput, $voucher->getTitle());
        $I->seeInField($this->voucherType, $voucher->getVoucherType());

        return $this;
    }
}