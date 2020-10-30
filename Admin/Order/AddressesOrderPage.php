<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Page\Page;

/**
 * class AddressesOrderPage
 *
 * @package OxidEsales\Codeception\Admin\Order
 */
class AddressesOrderPage extends Page
{
    use OrderList;

    public $firstNameInAddressesTab = "//input[@name='editval[oxorder__oxbillfname]']";
    public $lastNameInAddressesTab = "//input[@name='editval[oxorder__oxbilllname]']";
    public $loginNameInAddressesTab = "//input[@name='editval[oxorder__oxbillemail]']";
    public $zipCodeInAddressesTab = "//input[@name='editval[oxorder__oxbillzip]']";
    public $cityInAddressesTab = "//input[@name='editval[oxorder__oxbillcity]']";
}
