<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page;

use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

class Category
{
    /**
     * @var AcceptanceTester
     */
    protected $user;

    // include url of current page
    public static $URL = '';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }


}
