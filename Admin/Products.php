<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Product\MainTab;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class Products extends Page
{
    public $numberInput = "//input[@name='where[oxarticles][oxartnum]']";
    public $languageSelect = "//select[@name='changelang']";
    public $searchForm = '#search';

    /**
     * @param string $language
     *
     * @return Products
     */
    public function switchLanguage(string $language): Products
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->selectOption($this->languageSelect, $language);
        $I->seeOptionIsSelected($this->languageSelect, $language);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }

    /**
     * @param string $field
     * @param string $value
     *
     * @return MainTab
     */
    public function find(string $field, string $value): MainTab
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame(); // Waits for list section to load

        $I->click($value);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new MainTab($I);
    }

    /**
     * @param string $artNum
     * @return MainTab
     */
    public function filterByArtNum(string $artNum): MainTab
    {
        return $this->find($this->numberInput, $artNum);
    }

    public function openDownloadsTab(): void
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate('tbclarticle_files'));

        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();
    }
}
