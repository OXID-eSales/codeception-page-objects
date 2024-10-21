<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category;

use OxidEsales\Codeception\Admin\Category\Popup\SortProductsPopup;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

class SortingCategoryPage extends Page
{
    use CategoryList;

    private string $sortProductsButton = "//input[@value='%s']";

    public function openSortingProductsPopup(): SortProductsPopup
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click(sprintf($this->sortProductsButton, Translator::translate('CATEGORY_ORDER_SORTCATEGORIES')));
        $I->switchToNextTab();
        $I->waitForDocumentReadyState();
        $I->waitForAjax();

        return new SortProductsPopup($I);
    }
}