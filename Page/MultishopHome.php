<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page;

use OxidEsales\Codeception\Page\Component\Footer\NewsletterBox;
use OxidEsales\Codeception\Page\Component\Footer\ServiceWidget;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Component\Header\Navigation;
use OxidEsales\Codeception\Page\Component\Header\SearchWidget;

/**
 * Class for home page
 * @package OxidEsales\Codeception\Page
 */
class MultishopHome extends Page
{
    // include url of current page
    public $URL = '/';

    public $shopLinkPathTemplate = "//div[@id='page']/div[2]//a[%s]";

    public function openShop(int $shopId)
    {
        $I = $this->user;
        $I->click(sprintf($this->shopLinkPathTemplate, $shopId));
        $I->waitForPageLoad();
    }
}
