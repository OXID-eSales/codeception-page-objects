<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Component\AdminMenu;
use OxidEsales\Codeception\Admin\Component\HeaderLinks;
use OxidEsales\Codeception\Page\Page;

class AdminPanel extends Page
{
    use AdminMenu;
    use HeaderLinks;
}
