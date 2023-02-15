<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Service;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\EshopCommunity\Application\Model\Diagnostics;

class DiagnosticsTool extends Page
{
    public string $startDiagnosticsButton = '#submitButton';

    public function startDiagnostics(): DiagnosticsTool
    {
        $I = $this->user;
        $I->click($this->startDiagnosticsButton);

        return $this;
    }

    public function seeDiagnosticResults(): DiagnosticsTool
    {
        $I = $this->user;
        $I->see(Translator::translate('OXDIAG_RESULT_SUCCESSFUL'));

        return $this;
    }
}
