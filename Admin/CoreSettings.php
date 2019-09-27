<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

/**
 * Class CoreSettings
 *
 * @package OxidEsales\Codeception\Page\Admin
 */
class CoreSettings extends \OxidEsales\Codeception\Page\Page
{
    public $newShopButtonId = '#btn.new';
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

        $I->selectEditFrame();

        $I->click($this->newShopButtonId);
        $I->wait(3);

        //create new shop
        $I->fillField($this->newShopNameField, $shopName);
        $I->checkOption($this->inheritParentProductsCheckbox);
        $option = $I->grabTextFrom($this->masterShopInSelectOption);
        $I->selectOption($this->shopParentSelect, $option);
        $I->click('Save');
        $I->wait(5);
        $I->checkOption($this->activeShopSelect);
        $I->click('Save');

        $I->selectListFrame();
        $I->waitForText($shopName, 10);
    }

    /**
     * @param string $subShopName
     */
    public function selectShopInList(string $subShopName)
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click($subShopName);
        $I->selectEditFrame();
        $I->waitForElement("//input[@value='{$subShopName}']");
    }
}
