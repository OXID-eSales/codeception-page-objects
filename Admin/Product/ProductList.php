<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Admin\Products;
use OxidEsales\Codeception\Module\Translation\Translator;

trait ProductList
{
    public string $searchNumberInput = "//input[@name='where[oxarticles][oxartnum]']";
    public string $languageSelect = "//select[@name='changelang']";
    public string $searchForm = '#search';
    public string $productStatusClass = "//tr[@id='row.1']/td";

    public function switchLanguage(string $language): MainProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->selectOption($this->languageSelect, $language);
        $I->seeOptionIsSelected($this->languageSelect, $language);
        $I->selectListFrame();
        $I->selectEditFrame();

        return new MainProductPage($I);
    }

    public function filterByProductNumber(string $value): Products
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($this->searchNumberInput, $value);
        $I->submitForm($this->searchForm, []);

        $I->selectListFrame();

        return $this;
    }

    public function find(string $field, string $value): MainProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);

        $I->selectListFrame();
        $I->click($value);

        return $this->openMainTab();
    }

    public function openMainTab(): MainProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_main'));
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new MainProductPage($I);
    }

    public function openExtendedTab(): ExtendedInformationPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_extend'));
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new ExtendedInformationPage($I);
    }

    public function openSelectionTab(): SelectionProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_attribute'));
        $I->selectEditFrame();

        return new SelectionProductPage($I);
    }

    public function openVariantsTab(): VariantsProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_variant'));
        $I->selectEditFrame();

        return new VariantsProductPage($I);
    }

    public function openDownloadsTab(): DownloadsProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_files'));
        $I->selectListFrame();
        $I->selectEditFrame();

        return new DownloadsProductPage($I);
    }

    public function openStockTab(): StockProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_stock'));
        $I->selectListFrame();
        $I->selectEditFrame();

        return new StockProductPage($I);
    }
}
