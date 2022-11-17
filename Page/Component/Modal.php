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
    private string $confirmDeletionBtn = '.modal-dialog .modal-content button.btn-danger';
    private string $deleteShippingAddressBtn = '//*[@id="delete_shipping_address_%s"]/div/div/div[3]/button[2]';

    public function confirmDeletion(): void
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $I->waitForElementClickable($this->confirmDeletionBtn);
        $I->seeAndClick(
            Locator::contains($this->confirmDeletionBtn, Translator::translate('DD_DELETE'))
        );
    }

    public function confirmShippingAddressDeletion($position): void
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $button = sprintf($this->deleteShippingAddressBtn, $position);
        $I->waitForElementClickable($button);
        $I->click(
            Locator::contains($button, Translator::translate('DD_DELETE'))
        );
    }
}
