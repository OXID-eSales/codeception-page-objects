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
    public function submitForm(?string $submitButton = null): void
    {
        $I = $this->user;
        $I->clickAndWait(
            $submitButton ?? Translator::translate('GENERAL_SAVE')
        );
        $I->selectEditFrame();
        $I->waitForPageLoad();
    }
}
