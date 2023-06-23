<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Product\MainProductPage;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class ModulesList
 *
 * @package OxidEsales\Codeception\Admin
 */
class CountryList extends \OxidEsales\Codeception\Page\Page
{
    public string $searchForm = '#search';
    public string $titleSearchField = "where[oxcountry][oxtitle]";

    /**
     * @param string $country
     *
     * @return CountryList
     */
    public function selectCountry(string $country): CountryList
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($this->titleSearchField, $country);
        $I->submitForm($this->searchForm, []);

        $I->selectListFrame();
        $I->click($country);
        $I->selectEditFrame();

        return $this;
    }
}
