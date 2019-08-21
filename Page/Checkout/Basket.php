<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for cart page
 * @package OxidEsales\Codeception\Page\Checkout
 */
class Basket extends Page
{
    use MiniBasket, AccountMenu;

    // include url of current page
    public $URL = '';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $basketSummary = '#basketGrandTotal';

    public $basketItemAmount = '#basketcontents_table #am_%s';

    public $basketItemTotalPrice = '//tr[@id="table_cartItem_%s"]/td[@class="totalPrice"]';

    public $basketItemTitle = '//tr[@id="table_cartItem_%s"]/td[2]/div[2]/a';

    public $basketItemId = '//tr[@id="table_cartItem_%s"]/td[2]/div[2]/div[1]';

    public $basketBundledItemAmount = '//tr[@id="table_cartItem_%s"]/td[4]';

    public $basketUpdateButton = '#basketcontents_table #basketUpdate';

    public $addBasketCouponField = '#input_voucherNr';

    public $addBasketCouponButton = '//div[@id="basketVoucher"]//button';

    public $removeBasketCoupon = '.couponData .removeFn';

    public $openGiftSelection = '//tr[@id="table_cartItem_%s"]/td[3]/a';

    /**
     * Update product amount in the basket
     *
     * @param float $amount
     * @param int   $itemPosition
     *
     * @return $this
     */
    public function updateProductAmount(float $amount, int $itemPosition = 1)
    {
        $I = $this->user;
        $I->fillField(sprintf($this->basketItemAmount, $itemPosition), $amount);
        $I->click($this->basketUpdateButton);
        return $this;
    }

    /**
     * Assert basket product
     *
     * $basketProducts[] = ['id' => productId,
     *                   'title' => productTitle,
     *                   'amount' => productAmount,
     *                   'totalPrice' => productTotalPrice]
     *
     * @param array $basketProducts
     * @param string $basketSummaryPrice
     *
     * @return $this
     */
    public function seeBasketContains(array $basketProducts, string $basketSummaryPrice)
    {
        $I = $this->user;
        foreach ($basketProducts as $key => $basketProduct) {
            $itemPosition = $key + 1;
            $I->see(Translator::translate('PRODUCT_NO') . ' ' . $basketProduct['id'], sprintf($this->basketItemId, $itemPosition));
            $I->see($basketProduct['title'], sprintf($this->basketItemTitle, $itemPosition));
            $I->see($basketProduct['totalPrice'], sprintf($this->basketItemTotalPrice, $itemPosition));
            $I->seeInField(sprintf($this->basketItemAmount, $itemPosition), $basketProduct['amount']);
        }
        $I->see($basketSummaryPrice, $this->basketSummary);
        return $this;
    }

    /**
     * Assert basket product
     *
     * $basketProduct = ['id' => productId,
     *                   'title' => productTitle,
     *                   'amount' => productAmount]
     *
     * @param array $basketProduct
     * @param int   $itemPosition
     *
     * @return $this
     */
    public function seeBasketContainsBundledProduct(array $basketProduct, int $itemPosition)
    {
        $I = $this->user;
        $I->see(Translator::translate('PRODUCT_NO') . ' ' . $basketProduct['id'], sprintf($this->basketItemId, $itemPosition));
        $I->see($basketProduct['title'], sprintf($this->basketItemTitle, $itemPosition));
        $I->see($basketProduct['amount'], sprintf($this->basketBundledItemAmount, $itemPosition));
        return $this;
    }

    /**
     * Opens next step: user checkout page
     *
     * @return UserCheckout
     */
    public function goToNextStep()
    {
        $I = $this->user;
        $I->click(Translator::translate('CONTINUE_TO_NEXT_STEP'));
        $I->waitForElement($this->breadCrumb);
        return new UserCheckout($I);
    }

    /**
     * @param string $couponNumber
     *
     * @return $this
     */
    public function addCouponToBasket(string $couponNumber)
    {
        $I = $this->user;
        $I->fillField($this->addBasketCouponField, $couponNumber);
        $I->click($this->addBasketCouponButton);
        return $this;
    }

    /**
     * @return $this
     */
    public function removeCouponFromBasket()
    {
        $I = $this->user;
        $I->click($this->removeBasketCoupon);
        return $this;
    }

    /**
     * Open gift selection widget (wrapping and gift card)
     *
     * @param int $itemPosition
     *
     * @return GiftSelection
     */
    public function openGiftSelection(int $itemPosition)
    {
        $I = $this->user;
        $I->click(sprintf($this->openGiftSelection, $itemPosition));
        $I->waitForText(Translator::translate('GIFT_OPTION'));
        return new GiftSelection($I);
    }
}
