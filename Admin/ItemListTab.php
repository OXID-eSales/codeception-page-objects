<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

/**
 * Class ListItemTab
 *
 * General admin list item tab click page.
 * This class is the base that should be extended.
 *
 * TAB_KEY constant should represent the tab class name which goes to tab a href like:
 * <a href="#someclassname">, in this case we have "someclassname" as TAB_KEY.
 *
 * @package OxidEsales\Codeception\Admin
 */
abstract class ItemListTab extends \OxidEsales\Codeception\Page\Page
{
    public const TAB_KEY = '';
}
