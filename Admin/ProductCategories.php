<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class ProductCategories
 *
 * @package OxidEsales\Codeception\Page\Admin
 */
class ProductCategories extends \OxidEsales\Codeception\Page\Page
{
    public $newItemButtonId = '#btn.new';
    public $newCategoryName = 'editval[oxcategories__oxtitle]';
    public $activeCategoryCheckbox = 'editval[oxcategories__oxactive]';

    /**
     * @param string $categoryName
     */
    public function createNewCategory(string $categoryName)
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->newItemButtonId);
        $I->wait(1);

        $I->checkOption($this->activeCategoryCheckbox);
        $I->fillField($this->newCategoryName, $categoryName);
        $I->click('Save');

        $I->selectListFrame();
        $I->waitForText($categoryName);
    }

    public function assignProductsToSelectedCategory()
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click('Assign Products');

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click('Assign all');
        $I->waitForAjax(10);
        $I->closeTab();
    }

    public function openRightsForSelectedCategory()
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->waitForElement("#transfer", 10);
        $I->selectListFrame();
        $I->click('Rights');
    }

    public function assignUserRightsToSeletedCategory()
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click('Assign User Groups (Exclusively visible)');

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click('Assign all');
        $I->waitForAjax(10);
        $I->closeTab();
    }
}
