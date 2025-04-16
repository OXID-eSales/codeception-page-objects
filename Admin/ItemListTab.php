<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

/**
 * @deprecated method will be removed in next major
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
