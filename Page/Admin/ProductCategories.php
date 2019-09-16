<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class ProductCategories
 *
 * @package OxidEsales\Codeception\Page\Admin
 */
class ProductCategories extends AdminPage
{

    public $newCategoryName = 'editval[oxcategories__oxtitle]';
    public $activeCategoryCheckbox = 'editval[oxcategories__oxactive]';

    /**
     * @param string $categoryName
     */
    public function createNewCategory(string $categoryName)
    {

        //todo strings remove and get translator or sth ?
        $I = $this->user;
        $I->switchToIFrame();
        $I->switchToIFrame($this->baseFormName);
        $I->switchToIFrame($this->editIframe);
        $I->click($this->newShopButtonId);
        //todo check wchy clicking too fast makes cat be not created
        $I->wait(3);
        $I->checkOption($this->activeCategoryCheckbox);
        $I->fillField($this->newCategoryName, $categoryName);
        $I->wait(3);
        $I->click('Save');
        $I->wait(10);
        $I->switchToIFrame();
    }

    public function assignProductsToSelectedCategory()
    {
        $I = $this->user;
        $I->switchToIFrame();
        $I->switchToIFrame($this->baseFormName);
        $I->switchToIFrame($this->editIframe);
        $I->click('Assign Products');

        $I->switchToNextTab();//codeception way of opening next window
        $I->wait(3);
        $I->click('Assign all');
        $I->wait(15);
        $I->closeTab();
        $I->switchToIFrame();
    }

    public function openRightsForSelectedCategory()
    {
        $I = $this->user;
        $I->switchToIFrame($this->baseFormName);
        $I->switchToIFrame($this->listIframe);
        $I->click('Rights');
        $I->wait(3);
        $I->switchToIFrame();
    }

    public function assignUserRightsToSeletedCategory()
    {
        $I = $this->user;
        $I->switchToIFrame($this->baseFormName);
        $I->switchToIFrame($this->editIframe);
        $I->click('Assign User Groups (Exclusively visible)');

        $I->switchToNextTab();//codeception way of opening next window
        $I->wait(3);
        $I->click('Assign all');
        $I->wait(15);
        $I->closeTab();
    }
}
