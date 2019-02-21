<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Header;

use OxidEsales\Codeception\Module\Context;
use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Page\Checkout\PaymentCheckout;
use OxidEsales\Codeception\Page\Checkout\UserCheckout;
use OxidEsales\Codeception\Module\Translation\Translator;

trait MiniBasket
{
    public static $miniBasketMenuElement = '//div[@class="btn-group minibasket-menu"]/button';

    public static $miniBasketTitle = '//div[@class="minibasket-menu-box"]/p';

    public static $miniBasketItemTitle = '//div[@id="basketFlyout"]/div/div[%s]/div[2]/a';

    public static $miniBasketItemAmount = '//div[@id="basketFlyout"]/div/div[%s]/div[1]/span';

    public static $miniBasketItemPrice = '//div[@id="basketFlyout"]/div/div[%s]/div[3]';

    public static $miniBasketSummaryPrice = '//div[@class="row minibasket-total-row"]/div[2]';

    /**
     * Assert basket product
     *
     * $basketProducts[] = ['title' => productTitle,
     *                   'price' => productPrice,
     *                   'amount' => productAmount,]
     *
     * @param array  $basketProducts
     * @param string $basketSummaryPrice
     * @param string $totalAmount
     *
     * @return $this
     */
    public function seeMiniBasketContains(array $basketProducts, $basketSummaryPrice, $totalAmount)
    {
        $I = $this->user;
        $this->openMiniBasket();
        $I->see( $totalAmount . ' ' . Translator::translate('ITEMS_IN_BASKET'));
        foreach ($basketProducts as $key => $basketProduct) {
            $itemPosition = $key + 1;
            $I->see($basketProduct['title'], $I->clearString(sprintf(self::$miniBasketItemTitle, $itemPosition)));
            $I->see($basketProduct['amount'], sprintf(self::$miniBasketItemAmount, $itemPosition));
            $I->see($basketProduct['price'], sprintf(self::$miniBasketItemPrice, $itemPosition));
        }
        $I->see($basketSummaryPrice, self::$miniBasketSummaryPrice);
        return $this;
    }

    /**
     * @return $this
     */
    public function openMiniBasket()
    {
        $I = $this->user;
        $I->waitForElement(self::$miniBasketMenuElement);
        $I->click(self::$miniBasketMenuElement);
        $I->see(Translator::translate('DISPLAY_BASKET'));
        return $this;
    }

    /**
     * @return UserCheckout|PaymentCheckout
     */
    public function openCheckout()
    {
        $I = $this->user;
        $I->click(Translator::translate('CHECKOUT'));
        $I->waitForPageLoad();
        if (Context::isUserLoggedIn()) {
            return new PaymentCheckout($I);
        } else {
            return new UserCheckout($I);
        }
    }

    /**
     * @return Basket
     */
    public function openBasketDisplay()
    {
        $I = $this->user;
        $I->click(Translator::translate('DISPLAY_BASKET'));
        $I->see(Translator::translate('CART'));
        return new Basket($I);
    }
}
