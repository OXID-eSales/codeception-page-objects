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
    public function createNewCategory(string $categoryName): ProductCategories
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

        return $this;
    }

    public function assignProductsToSelectedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click('Assign Products');

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click('Assign all');
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }

    public function openRightsForSelectedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->waitForElement("#transfer", 10);
        $I->selectListFrame();
        $I->click('Rights');

        return $this;
    }

    public function assignUserRightsToSeletedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click('Assign User Groups (Exclusively visible)');

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click('Assign all');
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }
}
