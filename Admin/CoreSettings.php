<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Component\EditForm;
use OxidEsales\Codeception\Admin\Component\Tabs;
use OxidEsales\Codeception\Admin\CoreSetting\CachingTab;
use OxidEsales\Codeception\Admin\CoreSetting\LicenseTab;
use OxidEsales\Codeception\Admin\CoreSetting\PerformanceTab;
use OxidEsales\Codeception\Admin\CoreSetting\SEOTab;
use OxidEsales\Codeception\Admin\CoreSetting\SettingsTab;
use OxidEsales\Codeception\Admin\CoreSetting\SystemTab;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class CoreSettings extends Page
{
    use EditForm;
    use Tabs;

    private string $activeShopSelect = "//input[@name='editval[oxshops__oxactive]']";
    private string $inheritParentProductsOption = 'editval[oxshops__oxisinherited]';
    private string $masterShopInSelectOption = '#shopparent option:nth-child(2)';
    private string $newShopButton = '#btn.new';
    private string $newShopNameField = '#shopname';
    private string $shopName = "//input[@name='editval[oxshops__oxname]']";
    private string $shopParentSelect = '#shopparent';
    private string $tabCaching = 'tbclshop_cache';
    private string $tabLicense = 'tbclshop_license';
    private string $tabPerformance = 'tbclshop_performance';
    private string $tabSEO = 'tbclshop_seo';

    public function createNewShop(string $shopName): CoreSettings
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->clickAndWait($this->newShopButton);
        $I->waitForElementVisible($this->newShopNameField);

        $I->fillField($this->newShopNameField, $shopName);
        $I->checkOption($this->inheritParentProductsOption);
        $I->selectOption(
            $this->shopParentSelect,
            $I->grabTextFrom($this->masterShopInSelectOption)
        );
        $this->submitForm();

        $I->waitForElementClickable($this->activeShopSelect);
        $I->checkOption($this->activeShopSelect);
        $this->submitForm();

        $I->selectListFrame();
        $I->waitForPageLoad();
        $I->seeText($shopName);

        return $this;
    }

    public function selectShopInList(string $subShopName): CoreSettings
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->seeText($subShopName);
        $I->clickAndWait($subShopName);
        $I->selectEditFrame();
        $I->waitForPageLoad();
        $I->retrySeeInField($this->shopName, $subShopName);

        return $this;
    }

    public function openSystemTab(): SystemTab
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclshop_system'));

        return new SystemTab($I);
    }

    public function openSettingsTab(): SettingsTab
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclshop_config'));

        return new SettingsTab($I);
    }

    public function openLicenseTab(): LicenseTab
    {
        $I = $this->user;
        $this->openTab(Translator::translate($this->tabLicense));
        $I->seeText(Translator::translate('SHOP_LICENSE_VERSION'));

        return new LicenseTab($I);
    }

    public function openPerformanceTab(): PerformanceTab
    {
        $I = $this->user;
        $this->openTab(Translator::translate($this->tabPerformance));

        return new PerformanceTab($I);
    }

    public function openSEOTab(): SEOTab
    {
        $I = $this->user;
        $this->openTab(Translator::translate($this->tabSEO));

        return new SEOTab($I);
    }

    public function openCacheTab(): CachingTab
    {
        $I = $this->user;
        $this->openTab(Translator::translate($this->tabCaching));

        return new CachingTab($I);
    }
}
