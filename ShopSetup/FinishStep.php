<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use OxidEsales\Codeception\Page\Page;

class FinishStep extends Page
{
    private string $shopLinkButton = '#linkToShop';
    private string $adminLinkButton = '#linkToAdmin';

    public function goToShop(): static
    {
        $I = $this->user;

        $I->seeElement($this->shopLinkButton);
        $I->click($this->shopLinkButton);

        return $this;
    }

    public function seeAdminLink(): static
    {
        $I = $this->user;

        $I->waitForElement($this->adminLinkButton);

        return $this;
    }
}
