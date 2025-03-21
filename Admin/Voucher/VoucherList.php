<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Voucher;

use OxidEsales\Codeception\Admin\Component\Tabs;
use OxidEsales\Codeception\Module\Translation\Translator;

trait VoucherList
{
    use Tabs;

    public string $titleField = 'where[oxvoucherseries][oxserienr]';
    public string $searchForm = '#search';

    public function findByTitle(string $value): MainVoucherPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($this->titleField, $value);
        $I->submitForm($this->searchForm, []);

        $I->selectListFrame();
        $I->clickAndWait($value);

        return $this->openMainTab();
    }

    public function openMainTab(): MainVoucherPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclvoucherserie_main'));

        return new MainVoucherPage($I);
    }
}
