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
 * tabHref attribute should have correct the tab link href value:
 * <a href="#someclassname">, in this case we have "#someclassname" as tabHref.
 *
 * @package OxidEsales\Codeception\Admin
 */
abstract class ItemListTab extends \OxidEsales\Codeception\Page\Page
{
    /**
     * @var string
     */
    protected $tabHref = '';

    /**
     * @var string
     */
    public $tabSelector = "//div[@class='tabs']//a[@href='%s']";

    /**
     * @return string
     */
    public function getTabHref(): string
    {
        return $this->tabHref;
    }

    /**
     * @return string
     */
    public function getTabSelector(): string
    {
        return sprintf($this->tabSelector, $this->getTabHref());
    }
}
