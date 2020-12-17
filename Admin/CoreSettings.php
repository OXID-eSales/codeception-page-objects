<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\CoreSetting\SettingsTab;
use OxidEsales\Codeception\Admin\CoreSetting\SystemTab;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class CoreSettings
 *
 * @package OxidEsales\Codeception\Admin
 */
class CoreSettings extends \OxidEsales\Codeception\Page\Page
{
    public $newShopButton = '#btn.new';
    public $newShopNameField = '#shopname';
    public $shopParentSelect = '#shopparent';
    public $activeShopSelect = 'editval[oxshops__oxactive]';
    public $masterShopInSelectOption = '#shopparent option:nth-child(2)';
    public $inheritParentProductsOption = 'editval[oxshops__oxisinherited]';
    public $shopName = 'editval[oxshops__oxname]';

    /**
     * @param string $shopName
     *
     * @return CoreSettings
     */
    public function createNewShop(string $shopName): CoreSettings
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->click($this->newShopButton);
        $I->wait(3);

        //create new shop
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

    /**
     * @param string $subShopName
     *
     * @return CoreSettings
     */
    public function selectShopInList(string $subShopName): CoreSettings
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click($subShopName);
        $I->selectEditFrame();
        $I->waitForText($subShopName, 30, $this->shopName);

        return $this;
    }

    /**
     * @return SystemTab
     */
    public function openSystemTab(): SystemTab
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate('tbclshop_system'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new SystemTab($I);
    }

    /**
     * @return SettingsTab
     */
    public function openSettingsTab(): SettingsTab
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate('tbclshop_config'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new SettingsTab($I);
    }
}
