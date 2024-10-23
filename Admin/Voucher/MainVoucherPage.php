<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Voucher;

use OxidEsales\Codeception\Admin\DataObject\VoucherSerie;
use OxidEsales\Codeception\Page\Page;

class MainVoucherPage extends Page
{
    use VoucherList;

    public string $titleInput = "//input[@name='editval[oxvoucherseries__oxserienr]']";
    public string $voucherType = "//select[@name='editval[oxvoucherseries__oxdiscounttype]']";
    public string $saveButton = "//input[@name='save']";
	public string $discountField = "//input[@name='editval[oxvoucherseries__oxdiscount]']";
	public string $allowSameSeriesYes = "//input[@name='editval[oxvoucherseries__oxallowsameseries]'][@value='1']";
	public string $allowSameSeriesNo = "//input[@name='editval[oxvoucherseries__oxallowsameseries]'][@value='0']";

    public function createVoucherSerie(VoucherSerie $voucher)
    {
        $I = $this->user;

        $I->fillField($this->titleInput, $voucher->getTitle());
        $I->selectOption($this->voucherType, $voucher->getVoucherType());
        $I->click($this->saveButton);
        $I->waitForDocumentReadyState();

        return $this;
    }

    public function seeVoucherSerie(VoucherSerie $voucher): self
    {
        $I = $this->user;

        $I->seeInField($this->titleInput, $voucher->getTitle());
        $I->seeInField($this->voucherType, $voucher->getVoucherType());

        return $this;
    }

	public function checkVoucherDiscountFieldForShipfreeVoucher(): void
	{
		$I = $this->user;

		$I->selectOption($this->voucherType, 'shipfree');

		$I->waitForElementVisible($this->discountField, 5);

		$I->seeElement($this->discountField);
		$I->seeElement($this->discountField, ['disabled' => 'true']);
		$I->seeInField($this->discountField, '0');
	}

	public function checkAllowSameSeriesRadioDisabled(): self
	{
		$I = $this->user;

		$I->waitForElementVisible($this->allowSameSeriesYes, 5);

		$I->seeCheckboxIsChecked($this->allowSameSeriesNo);
		$I->seeElement($this->allowSameSeriesYes, ['disabled' => 'true']);
		$I->dontSeeElement($this->allowSameSeriesNo, ['disabled' => 'true']);

		return $this;
	}
}