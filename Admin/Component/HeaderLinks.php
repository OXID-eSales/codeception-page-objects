<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

trait HeaderLinks
{
    public $homeLink = "#homelink";
    public $shopsStartPageLink = "#shopfrontlink";
    public $logoutLink = "#logoutlink";
    public $versionLabel = '.version';

    public function openShopsStartPage(): void
    {
        $I = $this->user;
        $I->selectHeaderFrame();
        $I->click($this->shopsStartPageLink);
        $I->switchToNextTab();
    }
}
