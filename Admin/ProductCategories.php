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
 * @package OxidEsales\Codeception\Admin
 */
class ProductCategories extends \OxidEsales\Codeception\Page\Page
{
    public $newItemButtonId = '#btn.new';
    public $newCategoryName = 'editval[oxcategories__oxtitle]';
    public $activeCategoryCheckbox = 'editval[oxcategories__oxactive]';
    public $categoryInformation = '#transfer';

    /**
     * @param string $categoryName
     *
     * @return ProductCategories
     */
    public function createNewCategory(string $categoryName): ProductCategories
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->newItemButtonId);
        $I->wait(1);

        $I->checkOption($this->activeCategoryCheckbox);
        $I->fillField($this->newCategoryName, $categoryName);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->selectListFrame();
        $I->waitForText($categoryName);

        return $this;
    }

    /**
     * @return ProductCategories
     */
    public function assignProductsToSelectedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('GENERAL_ASSIGNARTICLES'));

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }

    /**
     * @return ProductCategories
     */
    public function openRightsForSelectedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->waitForElement($this->categoryInformation, 10);
        $I->selectListFrame();
        $I->click(Translator::translate('tbclcategory_rights'));

        return $this;
    }

    /**
     * @return ProductCategories
     */
    public function assignUserRightsToSeletedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('CATEGORY_RIGHTS_ASSIGNVISIBLE'));

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }
}
