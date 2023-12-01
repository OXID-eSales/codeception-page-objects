<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

class ProductCategories extends \OxidEsales\Codeception\Page\Page
{
    public $searchForm = '#search';
    public $newItemButtonId = '#btn.new';
    public $newCategoryName = 'editval[oxcategories__oxtitle]';
    public $activeCategoryCheckbox = 'editval[oxcategories__oxactive]';
    public $categoryInformation = '#transfer';
    public $categoryInput = 'where[oxcategories][oxtitle]';

    private string $newCategoryThumbFile = 'myfile[TC@oxcategories__oxthumb]';

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

    public function uploadThumbnail(string $categoryThumbPath): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();

        $I->attachFile($this->newCategoryThumbFile, $categoryThumbPath);
        $I->click(Translator::translate('GENERAL_SAVE'));

        return $this;
    }

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

    public function openRightsForSelectedCategory(): ProductCategories
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->waitForElement($this->categoryInformation, 10);
        $I->selectListFrame();
        $I->click(Translator::translate('tbclcategory_rights'));

        return $this;
    }

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
