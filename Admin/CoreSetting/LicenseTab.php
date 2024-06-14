<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

final class LicenseTab extends Page
{
    private string $shopLicenseInfoBlock = '#tShopLicense';
    private string $versionUpdateInfoBlock = '#tVersionInfo';
    private string $versionCheckerResponseCurrentVersion = 'Your OXID eShop Version is';
    private string $versionCheckerResponseLatestVersion = 'Latest OXID eShop Version is';

    public function seeShopVersionInfo(): self
    {
        $I = $this->user;

        $I->see(Translator::translate('SHOP_LICENSE_ALLOWEDMANDATES'), $this->shopLicenseInfoBlock);
        $I->see(Translator::translate('SHOP_LICENSE_USEDMANDATES'), $this->shopLicenseInfoBlock);

        $I->see($this->versionCheckerResponseCurrentVersion, $this->versionUpdateInfoBlock);
        $I->see($this->versionCheckerResponseLatestVersion, $this->versionUpdateInfoBlock);

        return $this;
    }
}
