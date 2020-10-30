<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Page\Page;

/**
 * class MainOrderPage
 *
 * @package OxidEsales\Codeception\Admin\Order
 */
class MainOrderPage extends Page
{
    use OrderList;
}
