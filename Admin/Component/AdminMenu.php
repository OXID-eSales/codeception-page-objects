<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Component;

use OxidEsales\Codeception\Admin\AdminPanel;
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
    public $coreSettingsLink = '/html/body/table/tbody/tr/td[1]/dl[1]/dd/ul/li[1]/a';
    public $categoryTitle = "//input[@name='editval[oxcategories__oxtitle]']";

    /**
     * @return CoreSettings
     */
    public function openCoreSettings(): CoreSettings
    {
        $I = $this->user;
        $I->selectBaseFrame();
        $I->waitForElementVisible($this->coreSettingsLink);
        $I->click($this->coreSettingsLink);
        //bad solution, but it works. try to figure out something reasonable
        $I->wait(3);

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
        $I->click(Translator::translate('NAVIGATION_HOME'));
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
        $I->click(Translator::translate('mxmanageprod'));
        $I->click(Translator::translate('mxcategories'));
        $I->selectEditFrame();
        $I->waitForElement($this->categoryTitle);

        return new ProductCategories($I);
    }

    /**
     * @return ModulesList
     */
    public function openModules(): ModulesList
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->click(Translator::translate('mxextensions'));
        $I->click(Translator::translate('mxmodule'));
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
        $I->click(Translator::translate('mxorders'));
        $I->click(Translator::translate('mxdisplayorders'));
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
        $I->click(Translator::translate('mxmanageprod'));
        $I->click(Translator::translate('mxarticles'));

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
        $I->click(Translator::translate('mxuadmin'));
        $I->click(Translator::translate('mxusers'));

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
        $I->click(Translator::translate('mxmainmenu'));
        $I->click(Translator::translate('mxlanguages'));

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
        $I->click(Translator::translate('mxservice'));
        $I->click(Translator::translate('mxtools'));

        $I->selectEditFrame();

        return new Tools($I);
    }
}
