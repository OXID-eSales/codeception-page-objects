<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Component\Header;

/**
 * Trait for currency menu widget.
 *
 * @package OxidEsales\Codeception\Page\Component\Header
 */
trait CurrencyMenu
{
    public $currencyMenuButton = "//div[@class='btn-group currencies-menu']/button";

    public $openCurrencyMenu = "//div[@class='btn-group currencies-menu open']";

    /**
     * @param string $currency
     *
     * @return $this
     */
    public function switchCurrency(string $currency)
    {
        $I = $this->user;

        $I->click($this->currencyMenuButton);
        $I->waitForElement($this->openCurrencyMenu);
        $I->click($currency);
        $I->waitForElement($this->currencyMenuButton);

        return $this;
    }
}
