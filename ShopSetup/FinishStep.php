<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use Codeception\Actor;
use OxidEsales\Codeception\Admin\AdminLoginPage;
use OxidEsales\Codeception\Page\Home;

class FinishStep extends SetupStep
{
    private string $shopLinkButton = '#linkToShop';
    private string $adminLinkButton = '#linkToAdmin';

    public function getWaitForStepLoadElement(): string
    {
        return $this->adminLinkButton;
    }

    public function openShop(Actor $IShop): Home
    {
        $homePage = new Home($IShop);
        $IShop->click($this->shopLinkButton);
        $IShop->waitForPageLoad();

        return $homePage;
    }

    public function openAdmin(Actor $IAdmin): AdminLoginPage
    {
        $adminLogin = new AdminLoginPage($IAdmin);
        $IAdmin->click($this->adminLinkButton);
        $IAdmin->waitForPageLoad();

        return $adminLogin;
    }
}
