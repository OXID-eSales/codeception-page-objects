<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use OxidEsales\Codeception\Module\Translation\Translator;

trait EditForm
{
    public function openForm(string $button): void
    {
        $this->clickAndWaitForFrameReload($button);
    }

    public function submitForm(?string $submitButton = null): void
    {
        $this->clickAndWaitForFrameReload(
            $submitButton ?? Translator::translate('GENERAL_SAVE')
        );
    }

    private function clickAndWaitForFrameReload(string $button): void
    {
        $I = $this->user;
        $documentMarker = $I->markEditFrameDocument();

        $I->clickAndWait($button);
        $I->waitForEditFrameReload($documentMarker);
    }
}
