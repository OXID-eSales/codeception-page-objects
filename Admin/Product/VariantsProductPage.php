<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class VariantsProductPage extends Page
{
    use ProductList;

    public $editVariantButton = '#test_variant\.%d > td:nth-child(1) > a';

    /**
     * @param int $variant
     *
     * @return MainProductPage
     */
    public function openEditProductVariant(int $variant): MainProductPage
    {
        $I = $this->user;

        $I->click(sprintf($this->editVariantButton, $variant));
        $I->waitForPageLoad();

        return new MainProductPage($I);
    }
}
