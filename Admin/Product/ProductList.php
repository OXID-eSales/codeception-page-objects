<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Module\Translation\Translator;

trait ProductList
{
    public $searchNumberInput = "//input[@name='where[oxarticles][oxartnum]']";
    public $languageSelect = "//select[@name='changelang']";
    public $searchForm = '#search';

    /**
     * @param string $language
     *
     * @return MainProductPage
     */
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

    /**
     * @param string $field
     * @param string $value
     *
     * @return MainProductPage
     */
    public function find(string $field, string $value): MainProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame();

        $I->click($value);
        $I->selectListFrame();
        $I->selectEditFrame();

        return new MainProductPage($I);
    }

    /** @return SelectionProductPage */
    public function openSelectionTab(): SelectionProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_attribute'));
        $I->selectEditFrame();

        return new SelectionProductPage($I);
    }

    /** @return VariantsProductPage */
    public function openVariantsTab(): VariantsProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_variant'));
        $I->selectEditFrame();

        return new VariantsProductPage($I);
    }

    /** @return DownloadsProductPage */
    public function openDownloadsTab(): DownloadsProductPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_files'));
        $I->selectListFrame();
        $I->selectEditFrame();

        return new DownloadsProductPage($I);
    }
}
