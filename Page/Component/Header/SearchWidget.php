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
    private string $searchField = '#searchParam';
    private string $searchButton = 'button[type=submit]';
    private string $searchForm = 'form[name=search]';

    public function searchFor(string $value): ProductSearchList
    {
        $I = $this->user;
        $I->fillField($this->searchField, $value);
        $button = sprintf('%s %s', $this->searchForm, $this->searchButton);
        $I->clickAndWait($button);
        $I->waitForElementClickable($button);

        return new ProductSearchList($I);
    }
}
