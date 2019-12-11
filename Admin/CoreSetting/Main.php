<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Admin\CoreSetting\Component\Footer;
use OxidEsales\Codeception\Admin\CoreSetting\Component\ItemList;
use OxidEsales\Codeception\Admin\CoreSetting\Component\ListHeader;
use OxidEsales\Codeception\Admin\CoreSetting\Component\SettingsMenu;
use OxidEsales\Codeception\Page\Page;

class Main extends Page
{
    use Footer, ListHeader, SettingsMenu, ItemList;

    public $newShopNameField = '#shopname';
    public $shopParentSelect = '#shopparent';
    public $activeShopSelect = 'editval[oxshops__oxactive]';
    public $masterShopInSelectOption = '#shopparent option:nth-child(2)';
    public $inheritParentProductsOption = 'editval[oxshops__oxisinherited]';

    /**
     * @param string $shopName
     *
     * @return $this
     */
    public function createNewShop(string $shopName): self
    {
        $I = $this->user;
        $I->fillField($this->newShopNameField, $shopName);
        $I->checkOption($this->inheritParentProductsOption);
        $option = $I->grabTextFrom($this->masterShopInSelectOption);
        $I->selectOption($this->shopParentSelect, $option);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->wait(5);
        $I->checkOption($this->activeShopSelect);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->selectListFrame();
        $I->waitForText($shopName, 10);

        return $this;
    }

}