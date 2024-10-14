<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Voucher\VoucherList;
use OxidEsales\Codeception\Page\Page;

class Vouchers extends Page
{
    use VoucherList;
}
