<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Admin\Component\DataTable;
use OxidEsales\Codeception\Admin\Component\Tabs;
use OxidEsales\Codeception\Admin\Products;
use OxidEsales\Codeception\Module\Translation\Translator;

trait ProductList
{
    use DataTable;
    use Tabs;

    public string $searchNumberInput = "//input[@name='where[oxarticles][oxartnum]']";
    public string $languageSelect = "//select[@name='changelang']";
    public string $searchForm = '#search';
    public string $productStatusClass = "//tr[@id='row.1']/td";
    private string $productNumberInput = 'oxartnum';

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
        $this->filterRows('oxarticles', $this->productNumberInput, $value);

        return $this;
    }

    public function findByProductNumber(string $productNumber): MainProductPage
    {
        $this->filterRows('oxarticles', $this->productNumberInput, $productNumber);
        $this->selectFirstRow();

        return $this->openMainTab();
    }

    public function find(string $field, string $value): MainProductPage
    {
        $I = $this->user;

        $this->filterRows('oxarticles', $field, $value);
        $this->selectFirstRow();

        return $this->openMainTab();
    }

    public function openMainTab(): MainProductPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclarticle_main'));

        return new MainProductPage($I);
    }

    public function openExtendedTab(): ExtendedInformationPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclarticle_extend'));

        return new ExtendedInformationPage($I);
    }

    public function openSelectionTab(): SelectionProductPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclarticle_attribute'));

        return new SelectionProductPage($I);
    }

    public function openVariantsTab(): VariantsProductPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclarticle_variant'));

        return new VariantsProductPage($I);
    }

    public function openDownloadsTab(): DownloadsProductPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclarticle_files'));

        return new DownloadsProductPage($I);
    }

    public function openStockTab(): StockProductPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclarticle_stock'));

        return new StockProductPage($I);
    }

    public function openPicturesTab(): PicturesProductPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclarticle_pictures'));

        return new PicturesProductPage($I);
    }

    public function openPictureAltTab(): PictureAltProductPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclarticle_picture_alt'));

        return new PictureAltProductPage($I);
    }
}
