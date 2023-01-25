<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Manufacturer\ManufacturerList;
use OxidEsales\Codeception\Page\Page;

class Manufacturers extends Page
{
    use ManufacturerList;
}
