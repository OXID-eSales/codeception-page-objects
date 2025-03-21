<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

final class LicenseTab extends Page
{
    private string $versionUpdateInfoBlock = '#tVersionInfo';
    private string $versionCheckerResponseCurrentVersion = 'Your OXID eShop Version is';
    private string $versionCheckerResponseLatestVersion = 'Latest OXID eShop Version is';

    public function seeShopVersionInfo(): self
    {
        $I = $this->user;
        $I->seeText($this->versionCheckerResponseCurrentVersion, $this->versionUpdateInfoBlock);
        $I->seeText($this->versionCheckerResponseLatestVersion, $this->versionUpdateInfoBlock);

        return $this;
    }
}
