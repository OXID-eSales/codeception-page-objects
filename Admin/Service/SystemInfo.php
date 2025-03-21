<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Service;

use OxidEsales\Codeception\Page\Page;

use function sprintf;

class SystemInfo extends Page
{
    private string $dateTableHeader =
        "//a[@name = '%s']/following::table[1]/tbody/tr[contains(td[@class='e'], '%s')]/td[@class='v']";

    public function setRowInDateTable(string $directive, string $vale): static
    {
        $this->seeTableRowWithDirectiveValuePair(
            'module_date',
            $directive,
            $vale,
        );

        return $this;
    }

    private function seeTableRowWithDirectiveValuePair(string $module, string $directive, string $vale): void
    {
        $I = $this->user;
        $I->selectBaseFrame();
        $selector = sprintf(
            $this->dateTableHeader,
            $module,
            $directive,
        );
        $I->seeText($vale, $selector);
    }
}
