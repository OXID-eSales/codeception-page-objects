<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Category\CategoryList;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class ProductCategories extends Page
{
    use CategoryList;

    /** @deprecated Use CategoryList trait properties instead */
    public $searchForm = '#search';
    /** @deprecated Use CategoryList trait properties instead */
    public $newItemButtonId = '#btn.new';
    /** @deprecated Use CategoryList trait properties instead */
    public $newCategoryName = 'editval[oxcategories__oxtitle]';
    /** @deprecated Use CategoryList trait properties instead */
    public $activeCategoryCheckbox = 'editval[oxcategories__oxactive]';
    /** @deprecated Use CategoryList trait properties instead */
    public $categoryInformation = '#transfer';
    /** @deprecated Use CategoryList trait properties instead */
    public $categoryInput = 'where[oxcategories][oxtitle]';

    /** @deprecated Use CategoryList trait properties instead */
    private string $newCategoryThumbFile = 'myfile[TC@oxcategories__oxthumb]';

    /**
     * @deprecated Use MainCategoryPage::create() instead
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
     * @deprecated Use MainCategoryPage::uploadThumbnail() instead
     */
    public function uploadThumbnail(string $categoryThumbPath): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();

        $I->attachFile($this->newCategoryThumbFile, $categoryThumbPath);
        $I->click(Translator::translate('GENERAL_SAVE'));

        return $this;
    }

    /**
     * @deprecated Use MainCategoryPage::openAssignProductsPopup() instead
     */
    public function assignProductsToSelectedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('GENERAL_ASSIGNARTICLES'));

        $I->switchToNextTab();
        $I->waitForDocumentReadyState();
        $I->click(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }

    /**
     * @deprecated Use CategoryList::openRightsTab() instead
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
     * @deprecated Use RightsCategoryPage::assignUserRightsToCategory() instead
     */
    public function assignUserRightsToSeletedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('CATEGORY_RIGHTS_ASSIGNVISIBLE'));

        $I->switchToNextTab();
        $I->waitForDocumentReadyState();
        $I->click(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }

    /**
     * @deprecated Use CategoryList::selectProductCategory() instead
     */
    public function selectCategory(string $categoryName): ProductCategories
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($this->categoryInput, $categoryName);
        $I->submitForm($this->searchForm, []);

        $I->selectListFrame();
        $I->click($categoryName);
        $I->selectEditFrame();

        return $this;
    }
}