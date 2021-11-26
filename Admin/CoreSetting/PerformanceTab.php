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
    /** @var string */
    public $disableSaveCartCheckbox = 'confbools[blPerfNoBasketSaving]';

    /** @return PerformanceTab */
    public function enableSaveCart(): PerformanceTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->uncheckOption($this->disableSaveCartCheckbox);
        $I->dontSeeCheckboxIsChecked($this->disableSaveCartCheckbox);
        return $this;
    }

    /** @return PerformanceTab */
    public function disableSaveCart(): PerformanceTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->checkOption($this->disableSaveCartCheckbox);
        $I->seeCheckboxIsChecked($this->disableSaveCartCheckbox);
        return $this;
    }

    /** @return PerformanceTab */
    public function save(): PerformanceTab
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->click('save');
        $I->waitForPageLoad();
        return $this;
    }
}
