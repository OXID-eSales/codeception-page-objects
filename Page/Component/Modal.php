<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component;

use Codeception\Util\Locator;
use OxidEsales\Codeception\Module\Translation\Translator;

trait Modal
{
    private $confirmDeletionBtn = '.modal-dialog .modal-body form button.btn-danger';

    public function confirmDeletion(): void
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $I->click(
            Locator::contains($this->confirmDeletionBtn, Translator::translate('DD_DELETE'))
        );
        $I->waitForPageLoad();
    }
}
