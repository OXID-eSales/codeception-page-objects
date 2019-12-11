<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Module;

use OxidEsales\Codeception\Admin\Module\Component\ItemList;
use OxidEsales\Codeception\Admin\Module\Component\SettingsMenu;
use OxidEsales\Codeception\Page\Page;

class Main extends Page
{
    use SettingsMenu, ItemList;
}