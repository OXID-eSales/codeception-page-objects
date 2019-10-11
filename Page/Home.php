<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page;

use OxidEsales\Codeception\Page\Component\Footer\NewsletterBox;
use OxidEsales\Codeception\Page\Component\Footer\ServiceWidget;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\LanguageMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Component\Header\Navigation;
use OxidEsales\Codeception\Page\Component\Header\SearchWidget;

/**
 * Class for home page
 * @package OxidEsales\Codeception\Page
 */
class Home extends Page
{
    use AccountMenu, NewsletterBox, SearchWidget, Navigation, MiniBasket, ServiceWidget, LanguageMenu;

    // include url of current page
    public $URL = '/';
}
