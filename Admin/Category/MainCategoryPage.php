<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category;

use OxidEsales\Codeception\Admin\Category\Popup\AssignProductsPopup;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

class MainCategoryPage extends Page
{
    use CategoryList;

    private string $newCategoryName = "//input[@name='editval[oxcategories__oxtitle]']";
    private string $activeCategoryCheckbox = "//input[@name='editval[oxcategories__oxactive]'][@type='checkbox']";
    private string $saveButton = "//input[@name='save']";
    private string $newItemButtonId = '#btn.new';
    private string $newCategoryThumbFile = 'myfile[TC@oxcategories__oxthumb]';
    private string $assignProductsButton = "//input[@value='%s']";

    public function create(string $categoryName): static
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->newItemButtonId);
        $I->selectListFrame();
        $I->selectEditFrame();
        $I->checkOption($this->activeCategoryCheckbox);
        $I->fillField($this->newCategoryName, $categoryName);
        $this->save();
        $I->selectListFrame();
        $I->waitForText($categoryName);

        return $this;
    }

    public function save(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click($this->saveButton);
        $I->waitForPageLoad();
        return $this;
    }

    public function uploadThumbnail(string $categoryThumbPath): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->attachFile($this->newCategoryThumbFile, $categoryThumbPath);
        $this->save();
        return $this;
    }

    public function openAssignProductsPopup(): AssignProductsPopup
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click(sprintf($this->assignProductsButton, Translator::translate('GENERAL_ASSIGNARTICLES')));
        $I->switchToNextTab();
        $I->waitForDocumentReadyState();
        $I->waitForAjax();

        return new AssignProductsPopup($I);
    }
}