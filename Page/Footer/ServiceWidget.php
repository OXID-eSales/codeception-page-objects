<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Footer;

use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

trait ServiceWidget
{
    /**
     * @var AcceptanceTester
     */
    protected $user;

    public static $basketLink = '//ul[@class="services list-unstyled"]';

    /**
     * @return Basket
     */
    public function openBasket()
    {
        $I = $this->user;
        $I->click(Translator::translate('CART'), self::$basketLink);
        return new Basket($I);
    }
}
