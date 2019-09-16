<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Admin;

use OxidEsales\Codeception\Page\Admin\Component\NavBar;

/**
 * Class CoreSettings
 *
 * @package OxidEsales\Codeception\Page\Admin
 */
class CoreSettings extends AdminPage
{

    use NavBar;

    public $newShopNameField = '#shopname';
    public $shopParentSelect = '#shopparent';
    public $activeShopSelect = 'editval[oxshops__oxactive]';
    public $masterShopInSelectOption = '#shopparent option:nth-child(2)';
    public $inheritParentProductsCheckbox = 'editval[oxshops__oxisinherited]';


    /**
     * @param string $shopName
     */
    public function createNewShop(string $shopName)
    {
        $I = $this->user;

        $I->switchToIFrame($this->baseFormName);
        $I->switchToIFrame($this->editIframe);

        $I->click($this->newShopButtonId);
        $I->wait(3);

        //create new shop
        $I->fillField($this->newShopNameField, $shopName);
        $I->checkOption($this->inheritParentProductsCheckbox);
        $option = $I->grabTextFrom($this->masterShopInSelectOption);
        $I->selectOption($this->shopParentSelect, $option);
        $I->click('Save');
        $I->wait(10);
        $I->checkOption($this->activeShopSelect);
        $I->click('Save');
        $I->wait(10);
        $I->switchToIFrame();
    }

}
