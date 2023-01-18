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
    use AccountMenu;
    use MiniBasket;

    // include url of current page
    public $URL = '';

    // include bread crumb of current page
    public $breadCrumb = '.breadcrumb';

    public $basketSummary = '//div[contains(text(),"%s")]/span';

    public $basketItemAmount = '#am_%s';

    public $basketItemTotalPrice = '//div[@id="list_cartItem_%s"]//div[contains(@class,"totalPrice")]/strong';

    public $basketItemTitle = '//div[@id="list_cartItem_%s"]//div[@class="h5"]';

    public $basketItemId = '//div[@id="list_cartItem_%s"]//ul[contains(@class,"serial-no")]';

    public $basketBundledItemAmount = '//div[@id="list_cartItem_%s"]//div[contains(@class,"quantity")]';

    public $basketUpdateButton = '//input[@id="am_%s"]/following-sibling::button';

    public $openBasketCouponField = '//h4[contains(text(),"%s")]';

    public $addBasketCouponField = '#input_voucherNr';

    public $addBasketCouponButton = '//div[@id="voucherCollapse"]//button';

    public $removeBasketCoupon = '.couponData .removeFn';

    public $openGiftSelection = '//div[@id="list_cartItem_%s"]//div[@class="wrapping"]/a';

    public string $basketItemAttributes = '//div[@id="list_cartItem_%s"]//ul[contains(@class,"attributes")]';

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
        $I->click(sprintf($this->basketUpdateButton, $itemPosition));
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
            $I->see(Translator::translate('PRODUCT_NO') .
                ' ' . $basketProduct['id'], sprintf($this->basketItemId, $itemPosition));
            $I->see($basketProduct['title'], sprintf($this->basketItemTitle, $itemPosition));
            $I->see($basketProduct['totalPrice'], sprintf($this->basketItemTotalPrice, $itemPosition));
            $I->seeInField(sprintf($this->basketItemAmount, $itemPosition), (string)$basketProduct['amount']);
        }
        $I->see($basketSummaryPrice, sprintf($this->basketSummary, Translator::translate('GRAND_TOTAL')));
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
        $I->see(Translator::translate('PRODUCT_NO') .
            ' ' . $basketProduct['id'], sprintf($this->basketItemId, $itemPosition));
        $I->see($basketProduct['title'], sprintf($this->basketItemTitle, $itemPosition));
        $I->see($basketProduct['amount'], sprintf($this->basketBundledItemAmount, $itemPosition));
        return $this;
    }

    public function seeBasketContainsAttribute(string $basketProductAttribute, int $itemPosition)
    {
        $I = $this->user;
        $I->see($basketProductAttribute, sprintf($this->basketItemAttributes, $itemPosition));
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
        $I->click(Translator::translate('CHECKOUT'));
        $userStep = new UserCheckout($I);
        $I->waitForElement($userStep->breadCrumb);
        return $userStep;
    }

    public function seeNextStep(): self
    {
        $I = $this->user;
        $I->see(Translator::translate('CHECKOUT'));
        return $this;
    }

    public function dontSeeNextStep(): self
    {
        $I = $this->user;
        $I->dontSee(Translator::translate('CHECKOUT'));
        return $this;
    }

    /**
     * @param string $couponNumber
     *
     * @return $this
     */
    public function addCouponToBasket(string $couponNumber)
    {
        $I = $this->user;
        $I->click(sprintf($this->openBasketCouponField, Translator::translate('COUPON')));
        $I->waitForElementVisible($this->addBasketCouponField);
        $I->fillField($this->addBasketCouponField, $couponNumber);
        $I->click($this->addBasketCouponButton);
        //TODO: missing functionality
        //$I->waitForElementVisible($this->removeBasketCoupon);
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
        $I->retryClick(sprintf($this->openGiftSelection, $itemPosition));
        $I->waitForText(Translator::translate('GIFT_OPTION'));
        return new GiftSelection($I);
    }
}
