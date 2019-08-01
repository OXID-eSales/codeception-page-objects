<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Component\Header;

use OxidEsales\Codeception\Module\Context;
use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Page\Checkout\PaymentCheckout;
use OxidEsales\Codeception\Page\Checkout\UserCheckout;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Trait for mini basket widget.
 * @package OxidEsales\Codeception\Page\Component\Header
 */
trait MiniBasket
{
    public $miniBasketMenuElement = '//div[@class="btn-group minibasket-menu"]/button';

    public $miniBasketTitle = '//div[@class="minibasket-menu-box"]/p';

    public $miniBasketItemTitle = '//div[@id="basketFlyout"]/table/tbody/tr[%s]/td[2]/a';

    public $miniBasketItemAmount = '//div[@id="basketFlyout"]/table/tbody/tr[%s]/td[1]/span';

    public $miniBasketItemPrice = '//div[@id="basketFlyout"]/table/tbody/tr[%s]/td[3]';

    public $miniBasketSummaryPrice = '//td[@class="total_price text-right"]';

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
    public function seeMiniBasketContains(array $basketProducts, string $basketSummaryPrice, string $totalAmount)
    {
        $I = $this->user;
        $this->openMiniBasket();
        $I->see( $totalAmount . ' ' . Translator::translate('ITEMS_IN_BASKET'));
        foreach ($basketProducts as $key => $basketProduct) {
            $itemPosition = $key + 1;
            $I->see($basketProduct['title'], $I->clearString(sprintf($this->miniBasketItemTitle, $itemPosition)));
            $I->see($basketProduct['amount'], sprintf($this->miniBasketItemAmount, $itemPosition));
            $I->see($basketProduct['price'], sprintf($this->miniBasketItemPrice, $itemPosition));
        }
        $I->see($basketSummaryPrice, $this->miniBasketSummaryPrice);
        return $this;
    }

    /**
     * Opens mini basket box.
     *
     * @return $this
     */
    public function openMiniBasket()
    {
        $I = $this->user;
        $I->waitForElement($this->miniBasketMenuElement);
        $I->click($this->miniBasketMenuElement);
        $I->waitForPageLoad();
        $I->see(Translator::translate('DISPLAY_BASKET'));
        return $this;
    }

    /**
     * Open checkout page.
     * If user is logged in, open PaymentCheckout page.
     * If user is not logged in, open UserCheckout page.
     *
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
     * Open cart page.
     *
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
