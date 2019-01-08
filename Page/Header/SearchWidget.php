<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Header;

use OxidEsales\Codeception\Page\ProductSearchList;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

trait SearchWidget
{
    /**
     * @var AcceptanceTester
     */
    protected $user;

    public static $searchField = '#searchParam';

    public static $searchButton = '';

    public static $searchForm = '//form[name=search]';

    /**
     * @param string $value
     *
     * @return ProductSearchList
     */
    public function searchFor($value)
    {
        $I = $this->user;
        $I->fillField(self::$searchField, $value);
        $I->click('form[name=search] button[type=submit]');
        return new ProductSearchList($I);
    }
}
