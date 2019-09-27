<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Page\Page;

/**
 * Class AdminPanel
 *
 * @package OxidEsales\Codeception\Page\Admin
 */
class AdminPanel extends Page
{
    public $productClassName = '.productClass';
    public $coreSettingsLink = '/html/body/table/tbody/tr/td[1]/dl[1]/dd/ul/li[1]/a';

    /**
     * @param string $baseFormName
     * @param string $coreSettingsLink
     *
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
     */
    public function returnToHome()
    {
        $I = $this->user;

        $I->selectHeaderFrame();
        $I->click("Home");
        $I->selectBaseFrame();
        $I->waitForText("Home");
    }

    /**
     * @param AdminPage $page
     *
     * @return ProductCategories
     */
    public function openCategories(): ProductCategories
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->click("Administer Products");
        $I->click("Categories");
        $I->selectEditFrame();
        $I->waitForElement("//input[@name='editval[oxcategories__oxtitle]']");

        return new ProductCategories($I);
    }

    /**
     * @return ProductCategories
     */
    public function openModules(): \OxidEsales\Codeception\Admin\ModulesList
    {
        $I = $this->user;

        $I->selectNavigationFrame();
        $I->click("Extensions");
        $I->click("Modules");
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new \OxidEsales\Codeception\Admin\ModulesList($I);
    }
}
