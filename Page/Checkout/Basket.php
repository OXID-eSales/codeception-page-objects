<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Page\Header\MiniBasket;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class Basket extends Page
{
    use MiniBasket;

    // include url of current page
    public static $URL = '';

    // include bread crumb of current page
    public static $breadCrumb = '#breadcrumb';

    public static $basketSummary = '#basketGrandTotal';

    public static $basketItemAmount = '#am_%s';

    public static $basketItemTotalPrice = '//li[@id="list_cartItem_%s"]//div[@class="totalPrice text-right"]';

    public static $basketItemTitle = '//li[@id="list_cartItem_%s"]/div/div[2]/div/div/a';

    public static $basketItemId = '//li[@id="list_cartItem_%s"]/div/div[2]/div/div/div';

    public static $basketBundledItemAmount = '//div[@id="basketItem-%s"]//div[@class="quantity"]';

    public static $basketUpdateButton = '#basketUpdate-%s';

    /**
     * Declare UI map for this page here. CSS or XPath allowed.
     * public static $usernameField = '#username';
     * public static $formSubmitButton = "#mainForm input[type=submit]";
     */

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($params)
    {
        return static::$URL.'/index.php?'.http_build_query($params);
    }

    /**
     * Update product amount in the basket
     *
     * @param int   $itemPosition
     * @param float $amount
     *
     * @return $this
     */
    public function updateProductAmount($amount, $itemPosition = 1)
    {
        $I = $this->user;
        $I->fillField(sprintf(self::$basketItemAmount, $itemPosition), $amount);
        $I->click(sprintf(self::$basketUpdateButton, $itemPosition));
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
    public function seeBasketContains($basketProducts, $basketSummaryPrice)
    {
        $I = $this->user;
        foreach ($basketProducts as $key => $basketProduct) {
            $itemPosition = $key + 1;
            $I->see(Translator::translate('PRODUCT_NO') . ' ' . $basketProduct['id'], sprintf(self::$basketItemId, $itemPosition));
            $I->see($basketProduct['title'], sprintf(self::$basketItemTitle, $itemPosition));
            $I->see($basketProduct['totalPrice'], sprintf(self::$basketItemTotalPrice, $itemPosition));
            $I->seeInField(sprintf(self::$basketItemAmount, $itemPosition), $basketProduct['amount']);
        }
        $I->see($basketSummaryPrice, self::$basketSummary);
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
    public function seeBasketContainsBundledProduct($basketProduct, $itemPosition)
    {
        $I = $this->user;
        $I->see(Translator::translate('PRODUCT_NO') . ' ' . $basketProduct['id'], sprintf(self::$basketItemId, $itemPosition));
        $I->see($basketProduct['title'], sprintf(self::$basketItemTitle, $itemPosition));
        $I->see($basketProduct['amount'], sprintf(self::$basketBundledItemAmount, $itemPosition));
        return $this;
    }

    /**
     * @return UserCheckout
     */
    public function goToNextStep()
    {
        $I = $this->user;
        $I->click(Translator::translate('CONTINUE_TO_NEXT_STEP'));
        $I->waitForElement(self::$breadCrumb);
        return new UserCheckout($I);
    }
}
