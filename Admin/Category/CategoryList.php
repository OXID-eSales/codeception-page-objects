<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category;

use OxidEsales\Codeception\Module\Translation\Translator;

trait CategoryList
{
    private string $categorySearchForm = '#search';
    private string $categoryTitleInput = "//input[@name='where[oxcategories][oxtitle]']";
    private string $categoryLanguageSelect = "//select[@name='changelang']";
    private string $categoryStatusClassSelector = "//tr[@id='row.1']/td";

    public function switchLanguage(string $language): MainCategoryPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->selectOption($this->categoryLanguageSelect, $language);
        $I->seeOptionIsSelected($this->categoryLanguageSelect, $language);
        $I->selectListFrame();
        $I->selectEditFrame();

        return new MainCategoryPage($I);
    }

    public function selectProductCategory(string $categoryName): MainCategoryPage
    {
        return $this->findCategory($categoryName);
    }

    private function findCategory(string $categoryName): MainCategoryPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($this->categoryTitleInput, $categoryName);
        $I->submitForm($this->categorySearchForm, []);

        $I->selectListFrame();
        $I->click($categoryName);
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new MainCategoryPage($I);
    }

    public function openMainTab(): MainCategoryPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclcategory_main'));
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new MainCategoryPage($I);
    }

    public function openSortingTab(): SortingCategoryPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $tabText = Translator::translate('tbclcategory_order');
        $tabSelector = "//div[contains(@class, 'tabs')]//a[contains(text(), '$tabText')]";
        $I->click($tabSelector);
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new SortingCategoryPage($I);
    }

    public function openRightsTab(): RightsCategoryPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclcategory_rights'));
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new RightsCategoryPage($I);
    }
}
