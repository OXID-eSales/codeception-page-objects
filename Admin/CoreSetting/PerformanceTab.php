<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

class PerformanceTab extends Page
{
    public string $disableSaveCartCheckbox = 'confbools[blPerfNoBasketSaving]';

    public function enableSaveCart(): PerformanceTab
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->uncheckOption($this->disableSaveCartCheckbox);
        $I->dontSeeCheckboxIsChecked($this->disableSaveCartCheckbox);
        return $this;
    }

    public function disableSaveCart(): PerformanceTab
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->checkOption($this->disableSaveCartCheckbox);
        $I->seeCheckboxIsChecked($this->disableSaveCartCheckbox);
        return $this;
    }

    public function save(): PerformanceTab
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->clickAndWait('save');

        return $this;
    }
}
