<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class VariantsTab extends Page
{
    public $editVariantButton = '#test_variant\.%d > td:nth-child(1) > a';
    public $selectionListsTitle = 'ARTICLE_VARIANT_SELECTLIST';

    /**
     * @param int $variant
     * @return MainTab
     */
    public function openEditProductVariant(int $variant): MainTab
    {
        $I = $this->user;
        $I->click(sprintf($this->editVariantButton, $variant));
        return (new MainTab($I))->waitForTab();
    }

    /** @return $this */
    public function waitForTab(): self
    {
        $I = $this->user;
        $I->waitForText(Translator::translate($this->selectionListsTitle));
        return $this;
    }
}
