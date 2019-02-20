<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Component\Footer;

use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Trait for service menu widget in footer
 * @package OxidEsales\Codeception\Page\Component\Footer
 */
trait ServiceWidget
{
    public $basketLink = '//ul[@class="services list-unstyled"]';

    /**
     * @return Basket
     */
    public function openBasket()
    {
        $I = $this->user;
        $I->click(Translator::translate('CART'), $this->basketLink);
        return new Basket($I);
    }
}
