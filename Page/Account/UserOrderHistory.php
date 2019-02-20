<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Account\Component\UserLogin;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for order-history page
 * @package OxidEsales\Codeception\Page\Account
 */
class UserOrderHistory extends Page
{
    use UserLogin;

    // include url of current page
    public $URL = '/en/order-history/';
}
