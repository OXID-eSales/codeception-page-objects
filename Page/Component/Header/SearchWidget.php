<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Header;

use OxidEsales\Codeception\Page\Lists\ProductSearchList;

use function sprintf;

trait SearchWidget
{
    public $searchField = '#searchParam';
    public $searchButton = 'button[type=submit]';
    public $searchForm = 'form[name=search]';

    /** @return ProductSearchList */
    public function searchFor(string $value)
    {
        $I = $this->user;
        $I->fillField($this->searchField, $value);
        $button = sprintf('%s %s', $this->searchForm, $this->searchButton);
        $I->click($button);
        $I->waitForElementClickable($button);
        return new ProductSearchList($I);
    }
}
