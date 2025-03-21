<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use Facebook\WebDriver\WebDriverKeys;

trait DataTable
{
    private string $firstRowName = '//tr[@id="row.1"]//td[2]//div//a';

    public function filterRows(string $model, string $field, string $value): void
    {
        $I = $this->user;
        $I->selectListFrame();
        $input = \sprintf(
            'input[name="where[%s][%s]"]',
            $model,
            $field
        );
        $I->retryFillField($input, $value);
        $I->retryPressKey($input, WebDriverKeys::ENTER);
        $I->waitForDocumentReadyState();
    }

    public function selectFirstRow(): void
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->clickAndWait($this->firstRowName);
        $I->selectEditFrame();
    }
}
