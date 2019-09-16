<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Admin\Component;

use OxidEsales\Codeception\Page\Admin\AdminPage;
use OxidEsales\Codeception\Page\Admin\AdminPanel;
use OxidEsales\Codeception\Page\Admin\CoreSettings;
use OxidEsales\Codeception\Page\Admin\ProductCategories;

/**
 * Trait NavBar
 *
 * @package OxidEsales\Codeception\Page\Admin\Component
 */
trait NavBar
{

    /**
     * @param string $baseFormName
     * @param string $coreSettingsLink
     *
     * @return CoreSettings
     */
    public function openCoreSettings(string $baseFormName, string $coreSettingsLink): CoreSettings
    {
        $I = $this->user;
        $I->switchToIFrame();
        $I->switchToIFrame($baseFormName);
        $I->waitForElementVisible($coreSettingsLink);
        $I->click($coreSettingsLink);
        //bad solution, but it works. try to figure out something reasonable
        $I->wait(3);
        $I->switchToIFrame();

        return new CoreSettings($I);
    }

    /**
     * @param string $headerIframe
     *
     * @return AdminPanel
     */
    public function returnToHome(string $headerIframe): AdminPanel
    {
        $I = $this->user;
        $I->switchToIFrame();
        $I->switchToIFrame($headerIframe);
        $I->click("Home");
        //bad solution
        $I->wait(10);

        return new AdminPanel($I);
    }

    /**
     * @param AdminPage $page
     *
     * @return ProductCategories
     */
    public function openCategories(AdminPage $page): ProductCategories
    {
        $I = $this->user;
        $I->switchToIFrame();
        $I->switchToIFrame($page->navigationIframe);
        $I->switchToIFrame($page->adminnavIframe);
        $I->click("Administer Products");
        $I->click("Categories");
        //bad solution, but it works. try to figure out something reasonable
        $I->wait(3);
        $I->switchToIFrame();

        return new ProductCategories($I);
    }

    /**
     * @param string $subShopName
     * @param string $baseFormName
     * @param string $listIframe
     */
    public function selectSubShop(string $subShopName, string $baseFormName, string $listIframe)
    {
        $I = $this->user;
        $I->switchToIFrame($baseFormName);
        $I->switchToIFrame($listIframe);
        $I->click($subShopName);
        $I->switchToIFrame();
    }
}