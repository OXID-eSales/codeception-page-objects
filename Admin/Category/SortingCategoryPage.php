<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category;

use OxidEsales\Codeception\Admin\Category\Popup\SortProductsPopup;
use OxidEsales\Codeception\Admin\Component\AssignPopup;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

use function sprintf;

class SortingCategoryPage extends Page
{
    use AssignPopup;
    use CategoryList;

    private string $sortProductsButton = "//input[@value='%s']";

    public function openSortingProductsPopup(): SortProductsPopup
    {
        $I = $this->user;
        $this->openAssignPopup(
            sprintf($this->sortProductsButton, Translator::translate('CATEGORY_ORDER_SORTCATEGORIES'))
        );
        $I->waitForElement('#container1 .yui-dt-data tr');

        return new SortProductsPopup($I);
    }
}
