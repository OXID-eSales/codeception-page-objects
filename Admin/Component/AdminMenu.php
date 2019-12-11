<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Component;

use OxidEsales\Codeception\Admin\AdminPanel;
use OxidEsales\Codeception\Admin\Category\Main as CategoryMain;
use OxidEsales\Codeception\Admin\Module\Main as ModuleMain;
use OxidEsales\Codeception\Admin\Order\Main as OrderMain;
use OxidEsales\Codeception\Admin\Product\Main as ProductMain;
use OxidEsales\Codeception\Admin\CoreSetting\Main as CoreSettingsMain;
use OxidEsales\Codeception\Admin\User\Main as UserMain;
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
     * @return CoreSettingsMain
     */
    public function openCoreSettings(): CoreSettingsMain
    {
        $I = $this->user;
        $I->selectBaseFrame();
        $I->waitForElementVisible($this->coreSettingsLink);
        $I->click($this->coreSettingsLink);
        //bad solution, but it works. try to figure out something reasonable
        $I->wait(3);

        return new CoreSettingsMain($I);
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
     * @return CategoryMain
     */
    public function openCategories(): CategoryMain
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->click(Translator::translate('mxmanageprod'));
        $I->click(Translator::translate('mxcategories'));
        $I->selectEditFrame();
        $I->waitForElement($this->categoryTitle);

        return new CategoryMain($I);
    }

    /**
     * @return ModuleMain
     */
    public function openModules(): ModuleMain
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->click(Translator::translate('mxextensions'));
        $I->click(Translator::translate('mxmodule'));
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new ModuleMain($I);
    }

    /**
     * @return OrderMain
     */
    public function openOrders(): OrderMain
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->click(Translator::translate('mxorders'));
        $I->click(Translator::translate('mxdisplayorders'));
        $I->waitForDocumentReadyState();

        return new OrderMain($I);
    }

    /**
     * @return ProductMain
     */
    public function openProducts(): ProductMain
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

        // Wait for product main section to load
        $I->selectEditFrame();

        return new ProductMain($I);
    }

    /**
     * @return UserMain
     */
    public function openUsers(): UserMain
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

        return new UserMain($I);
    }
}
