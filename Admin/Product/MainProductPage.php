<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Page\Page;

class MainProductPage extends Page
{
    use ProductList;

    public string $activeCheckbox = "//input[@name='editval[oxarticles__oxactive]'][@type='checkbox']";
    public string $titleInput = "//input[@name='editval[oxarticles__oxtitle]']";
    public string $numberInput = "//input[@name='editval[oxarticles__oxartnum]']";
    public string $priceInput = "//input[@name='editval[oxarticles__oxprice]']";
    public string $longDescriptionInput = '#editor_oxarticles__oxlongdesc';
    public string $createButton = "//a[@id='btn.new']";
    public string $saveButton = "//input[@name='saveArticle']";

    public function create(string $title, ?string $number = null, ?int $price = null): self
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->createButton);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->titleInput, $title);

        if ($number) {
            $I->fillField($this->numberInput, $number);
        }

        if ($price) {
            $I->fillField($this->priceInput, $price);
        }

        $I->waitForElementClickable($this->saveButton);
        $I->click($this->saveButton);
        $I->selectEditFrame();
        $I->selectListFrame();

        return $this;
    }

    public function save(): MainProductPage
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click($this->saveButton);
        $I->waitForPageLoad();
        return $this;
    }
}
