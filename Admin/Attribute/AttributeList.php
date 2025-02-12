<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Attribute;

use OxidEsales\Codeception\Module\Translation\Translator;

trait AttributeList
{
    private string $attributeSearchField = "//input[@name='where[oxattribute][oxtitle]']";
    private string $searchForm = '#search';

    public function openMainTab(): MainAttributePage
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate('tbclattribute_main'));
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new MainAttributePage($I);
    }

    public function openCategoryTab(): CategoryAttributePage
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->click(Translator::translate('tbclattribute_category'));
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new CategoryAttributePage($I);
    }

    public function selectAttribute(string $attributeName): MainAttributePage
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->fillField($this->attributeSearchField, $attributeName);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame();
        $I->click($attributeName);
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return new MainAttributePage($I);
    }
}
