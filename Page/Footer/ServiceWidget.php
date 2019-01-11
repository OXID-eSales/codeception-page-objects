<?php
namespace OxidEsales\Codeception\Page\Footer;

use OxidEsales\Codeception\Page\Basket;
use OxidEsales\Codeception\Module\Translator;

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
        $I->click(Translator::translate('CART'), self::$basketLink);
        return new Basket($I);
    }
}
