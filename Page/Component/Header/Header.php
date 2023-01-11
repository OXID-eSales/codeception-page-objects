<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Header;

/**
 * Trait for account menu widget.
 * @package OxidEsales\Codeception\Page\Component\Header
 */
trait Header
{
    use AccountMenu, SearchWidget, Navigation, MiniBasket, LanguageMenu, CurrencyMenu;
}
