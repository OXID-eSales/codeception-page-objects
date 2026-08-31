<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use OxidEsales\Codeception\Admin\AdminPanel;
use OxidEsales\Codeception\Admin\CMSPages;
use OxidEsales\Codeception\Admin\CoreSettings;
use OxidEsales\Codeception\Admin\CountryList;
use OxidEsales\Codeception\Admin\Languages;
use OxidEsales\Codeception\Admin\Locales;
use OxidEsales\Codeception\Admin\Manufacturers;
use OxidEsales\Codeception\Admin\ModulesList;
use OxidEsales\Codeception\Admin\Newsletter;
use OxidEsales\Codeception\Admin\Orders;
use OxidEsales\Codeception\Admin\ProductCategories;
use OxidEsales\Codeception\Admin\Products;
use OxidEsales\Codeception\Admin\SelectionLists;
use OxidEsales\Codeception\Admin\Service\DiagnosticsTool;
use OxidEsales\Codeception\Admin\Service\GenericExport;
use OxidEsales\Codeception\Admin\Service\GenericImport;
use OxidEsales\Codeception\Admin\Service\SystemHealth;
use OxidEsales\Codeception\Admin\Service\SystemInfo;
use OxidEsales\Codeception\Admin\Service\Tools;
use OxidEsales\Codeception\Admin\Users;
use OxidEsales\Codeception\Admin\Vouchers;
use OxidEsales\Codeception\Module\Translation\Translator;

trait AdminMenu
{
    /**
     * @return CoreSettings
     */
    public function openCoreSettings(): CoreSettings
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxmainmenu'));
        $I->clickAndWait(Translator::translate('mxcoresett'));
        $this->waitForListTable();

        return new CoreSettings($I);
    }

    /**
     * @return CountryList
     */
    public function openCountries(): CountryList
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxmainmenu'));
        $I->clickAndWait(Translator::translate('mxcountries'));
        $this->waitForListTable();

        return new CountryList($I);
    }

    public function openManufacturers(): Manufacturers
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxmainmenu'));
        $I->clickAndWait(Translator::translate('mxmanufacturer'));
        $this->waitForListTable();

        return new Manufacturers($I);
    }

    public function openHomePage(): AdminPanel
    {
        $I = $this->user;

        $I->selectHeaderFrame();
        $I->clickAndWait(Translator::translate('NAVIGATION_HOME'));
        $I->selectBaseFrame();
        $I->seeText(Translator::translate('NAVIGATION_HOME'));

        return new AdminPanel($I);
    }

    public function openCategories(): ProductCategories
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxmanageprod'));
        $I->clickAndWait(Translator::translate('mxcategories'));

        return new ProductCategories($I);
    }

    public function openSelectionLists(): SelectionLists
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxmanageprod'));
        $I->clickAndWait(Translator::translate('mxsellist'));
        $this->waitForListTable();

        return new SelectionLists($I);
    }

    public function openModules(): ModulesList
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxextensions'));
        $I->clickAndWait(Translator::translate('mxmodule'));
        $this->waitForListTable();

        return new ModulesList($I);
    }

    public function openOrders(): Orders
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxorders'));
        $I->clickAndWait(Translator::translate('mxdisplayorders'));
        $this->waitForListTable();

        return new Orders($I);
    }

    public function openProducts(): Products
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxmanageprod'));
        $I->clickAndWait(Translator::translate('mxarticles'));
        $this->waitForListTable();

        return new Products($I);
    }

    public function openUsers(): Users
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxuadmin'));
        $I->clickAndWait(Translator::translate('mxusers'));
        $this->waitForListTable();

        return new Users($I);
    }

    public function openLanguages(): Languages
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxmainmenu'));
        $I->clickAndWait(Translator::translate('mxlanguages'));
        $this->waitForListTable();

        return new Languages($I);
    }

    public function openLocales(): Locales
    {
        $I = $this->user;
        $localesPage = new Locales($I);

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxmainmenu'));
        $I->clickAndWait(Translator::translate('mxlocales'));
        $I->selectBaseFrame();
        $I->waitForElementVisible($localesPage->localeManager);

        return $localesPage;
    }

    public function openDiagnosticsTool(): DiagnosticsTool
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxservice'));
        $I->clickAndWait(Translator::translate('oxdiag_menu'));
        $I->selectEditFrame();
        $I->seeText(Translator::translate('OXDIAG_HOME'));


        return new DiagnosticsTool($I);
    }

    public function openTools(): Tools
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxservice'));
        $I->clickAndWait(Translator::translate('mxtools'));

        $I->selectEditFrame();

        return new Tools($I);
    }

    public function openSystemInfo(): SystemInfo
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxservice'));
        $I->clickAndWait(Translator::translate('mxsysinfo'));
        $I->selectBaseFrame();

        return new SystemInfo($I);
    }

    public function openSystemHealth(): SystemHealth
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxservice'));
        $I->clickAndWait(Translator::translate('mxsysreq'));
        $I->selectEditFrame();

        return new SystemHealth($I);
    }

    public function openCMSPages(): CMSPages
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxcustnews'));
        $I->clickAndWait(Translator::translate('mxcontent'));

        $I->selectEditFrame();

        return new CMSPages($I);
    }

    public function openNewsletter(): Newsletter
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxcustnews'));
        $I->clickAndWait(Translator::translate('mxnewsletter'));

        $I->selectBaseFrame();

        return new Newsletter($I);
    }

    public function openGenericImport(): GenericImport
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxservice'));
        $I->clickAndWait(Translator::translate('mxgenimp'));

        $I->selectBaseFrame();

        return new GenericImport($I);
    }

    public function openGenericExport(): GenericExport
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxservice'));
        $I->clickAndWait(Translator::translate('mxgenexp'));

        $I->selectGenericExportMainFrame();

        return new GenericExport($I);
    }

    public function openVouchers(): Vouchers
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->clickAndWait(Translator::translate('mxshopsett'));
        $I->clickAndWait(Translator::translate('mxvouchers'));
        $this->waitForListTable();

        return new Vouchers($I);
    }

    private function waitForListTable(): void
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->waitForDocumentReadyState();
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();
    }
}
