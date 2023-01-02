<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Component\Header;

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\LanguageMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Component\Header\Navigation;
use OxidEsales\Codeception\Page\Component\Header\SearchWidget;

/**
 * Trait for account menu widget.
 * @package OxidEsales\Codeception\Page\Component\Header
 */
trait Header
{
    use AccountMenu, SearchWidget, Navigation, MiniBasket, LanguageMenu;
}
