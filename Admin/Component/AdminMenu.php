<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Component;

use OxidEsales\Codeception\Admin\AdminPanel;
use OxidEsales\Codeception\Admin\CoreSettings;
use OxidEsales\Codeception\Admin\ModulesList;
use OxidEsales\Codeception\Admin\ProductCategories;
use OxidEsales\Codeception\Admin\Products;
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
}
