<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component;

use OxidEsales\Codeception\Module\Translation\Translator;

trait Pagination
{
    private $paginationControlsBottom = '#itemsPagerbottom';
    private $paginationNextBtn = 'ol.pagination>li.next>a';

    public function dontSeeBottomPaginationElements(): void
    {
        $I = $this->user;
        $I->dontSee(Translator::translate('NEXT'), $this->paginationControlsBottom);
        $I->dontSee(Translator::translate('PREVIOUS'), $this->paginationControlsBottom);
        $I->dontSee(Translator::translate('1'), $this->paginationControlsBottom);
    }

    public function goToNextPage(): void
    {
        $I = $this->user;
        $I->click($this->paginationNextBtn);
        $I->waitForPageLoad();
    }
}
