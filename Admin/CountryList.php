<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Page\Page;

class CountryList extends Page
{
    public string $searchForm = '#search';
    public string $titleSearchField = "where[oxcountry][oxtitle]";

    public function selectCountry(string $country): CountryList
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($this->titleSearchField, $country);
        $I->submitForm($this->searchForm, []);

        $I->selectListFrame();
        $I->clickAndWait($country);
        $I->selectEditFrame();

        return $this;
    }
}
