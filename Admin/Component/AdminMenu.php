<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Component;

use OxidEsales\Codeception\Admin\AdminPanel;
use OxidEsales\Codeception\Admin\CMSPages;
use OxidEsales\Codeception\Admin\CoreSettings;
use OxidEsales\Codeception\Admin\Languages;
use OxidEsales\Codeception\Admin\ModulesList;
use OxidEsales\Codeception\Admin\Orders;
use OxidEsales\Codeception\Admin\ProductCategories;
use OxidEsales\Codeception\Admin\Products;
use OxidEsales\Codeception\Admin\Tools;
use OxidEsales\Codeception\Admin\Users;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Trait AdminMenu
 *
 * @package OxidEsales\Codeception\Admin\Component
 */
trait AdminMenu
{
    /**
     * @return CoreSettings
     */
    public function openCoreSettings(): CoreSettings
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->retryClick(Translator::translate('mxmainmenu'));
        $I->retryClick(Translator::translate('mxcoresett'));

        $I->selectListFrame();
        $I->selectEditFrame();

        return new CoreSettings($I);
    }

    /**
     * Opens Home page of Admin panel
     *
     * @return AdminPanel
     */
    public function openHomePage(): AdminPanel
    {
        $I = $this->user;

        $I->selectHeaderFrame();
        $I->retryClick(Translator::translate('NAVIGATION_HOME'));
        $I->selectBaseFrame();
        $I->waitForText(Translator::translate('NAVIGATION_HOME'));

        return new AdminPanel($I);
    }

    /**
     * @return ProductCategories
     */
    public function openCategories(): ProductCategories
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->retryClick(Translator::translate('mxmanageprod'));
        $I->retryClick(Translator::translate('mxcategories'));
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new ProductCategories($I);
    }

    /**
     * @return ModulesList
     */
    public function openModules(): ModulesList
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->retryClick(Translator::translate('mxextensions'));
        $I->retryClick(Translator::translate('mxmodule'));
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new ModulesList($I);
    }

    /**
     * @return Orders
     */
    public function openOrders(): Orders
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->retryClick(Translator::translate('mxorders'));
        $I->retryClick(Translator::translate('mxdisplayorders'));
        $I->waitForDocumentReadyState();

        return new Orders($I);
    }

    /**
     * @return Products
     */
    public function openProducts(): Products
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->retryClick(Translator::translate('mxmanageprod'));
        $I->retryClick(Translator::translate('mxarticles'));

        // After clicking on Products link two requests are executed:
        // - load product list section
        // - load product main section

        // Wait for product list section to load
        $I->selectListFrame();

        // Wait for product list section to load
        $I->selectEditFrame();

        return new Products($I);
    }

    /**
     * @return Users
     */
    public function openUsers(): Users
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->retryClick(Translator::translate('mxuadmin'));
        $I->retryClick(Translator::translate('mxusers'));

        // After clicking on Users link two requests are executed:
        // - load user list section
        // - load user main section

        // Wait for user list section to load
        $I->selectListFrame();

        // Wait for user main section to load
        $I->selectEditFrame();

        return new Users($I);
    }

    /**
     * @return Languages
     */
    public function openLanguages(): Languages
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->retryClick(Translator::translate('mxmainmenu'));
        $I->retryClick(Translator::translate('mxlanguages'));

        $I->selectListFrame();
        $I->selectEditFrame();

        return new Languages($I);
    }

    /**
     * @return Tools
     */
    public function openTools(): Tools
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->retryClick(Translator::translate('mxservice'));
        $I->retryClick(Translator::translate('mxtools'));

        $I->selectEditFrame();

        return new Tools($I);
    }

    /**
     * @return CMSPages
     */
    public function openCMSPages(): CMSPages
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->retryClick(Translator::translate('mxcustnews'));
        $I->retryClick(Translator::translate('mxcontent'));

        $I->selectEditFrame();

        return new CMSPages($I);
    }
}
