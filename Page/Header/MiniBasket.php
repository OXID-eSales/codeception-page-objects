<?php
namespace OxidEsales\Codeception\Page\Header;

use Helper\Context;
use OxidEsales\Codeception\Page\Basket;
use OxidEsales\Codeception\Page\PaymentCheckout;
use OxidEsales\Codeception\Page\UserCheckout;
use OxidEsales\Codeception\Module\Translator;

trait MiniBasket
{
    public static $miniBasketMenuElement = '//div[@class="btn-group minibasket-menu"]/button';

    public static $miniBasketTitle = '//div[@class="minibasket-menu-box"]/p';

    public static $miniBasketItemTitle = '//div[@id="basketFlyout"]/table/tbody/tr[%s]/td[2]/a';

    public static $miniBasketItemAmount = '//div[@id="basketFlyout"]/table/tbody/tr[%s]/td[1]/span';

    public static $miniBasketItemPrice = '//div[@id="basketFlyout"]/table/tbody/tr[%s]/td[3]';

    public static $miniBasketSummaryPrice = '//td[@class="total_price text-right"]';

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
        /** @var \AcceptanceTester $I */
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
        /** @var \AcceptanceTester $I */
        $I = $this->user;
        $I->click(self::$miniBasketMenuElement);
        return $this;
    }

    /**
     * @return UserCheckout|PaymentCheckout
     */
    public function openCheckout()
    {
        /** @var \AcceptanceTester $I */
        $I = $this->user;
        $I->click(Translator::translate('CHECKOUT'));
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
        /** @var \AcceptanceTester $I */
        $I = $this->user;
        $I->click(Translator::translate('DISPLAY_BASKET'));
        return new Basket($I);
    }
}
