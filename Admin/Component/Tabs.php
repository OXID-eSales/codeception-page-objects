<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use function sprintf;

trait Tabs
{
    private string $tabButton = "//div[@class='tabs']//a[text()='%s']";
    private string $activeTab = ".%s/ancestor-or-self::td[contains(@class, ' active') and contains(@class, 'tab')]";

    public function openTab(string $tabName): void
    {
        $I = $this->user;
        $I->selectListFrame();
        $button = sprintf($this->tabButton, $tabName);
        $I->clickAndWait($button);
        $I->waitForElementVisible(
            sprintf($this->activeTab, $button)
        );
        $I->selectEditFrame();
        $I->waitForJs('return window.document.readyState === "complete";');
    }
}
