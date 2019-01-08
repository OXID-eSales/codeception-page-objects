<?php
namespace OxidEsales\Codeception\Page\Footer;

use OxidEsales\Codeception\Page\Basket;

trait ServiceWidget
{
    public static $basketLink = '//ul[@class="services list-unstyled"]';

    /**
     * @return Basket
     */
    public function openBasket()
    {
        /** @var \AcceptanceTester $I */
        $I = $this->user;
        $I->click($I->translate('CART'), self::$basketLink);
        return new Basket($I);
    }
}
