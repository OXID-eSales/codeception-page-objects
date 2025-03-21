<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Page\Page;

use function sprintf;

class VariantsProductPage extends Page
{
    use ProductList;

    public string $editVariantButton = '#test_variant\.%d > td:nth-child(1) > a';

    public function openEditProductVariant(int $variant): MainProductPage
    {
        $I = $this->user;
        $editButton = sprintf($this->editVariantButton, $variant);
        $I->clickAndWait($editButton);
        $I->waitForElementNotVisible($editButton);

        return new MainProductPage($I);
    }
}
