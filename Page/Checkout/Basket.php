<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class Basket extends Page
{
    use AccountMenu;
    use MiniBasket;

    public $URL = '';
    public $breadCrumb = '#breadcrumb';
    public string $basketSummary = '#basketGrandTotal';
    public string $basketItemAmount = '#basketcontents_table #am_%s';
    public string $basketItemTotalPrice = '//tr[@id="table_cartItem_%s"]/td[@class="totalPrice"]';
    public string $basketItemTitle = '//tr[@id="table_cartItem_%s"]/td[2]/div[2]/a';
    public string $basketItemId = '//tr[@id="table_cartItem_%s"]/td[2]/div[2]/div[1]';
    public string $basketBundledItemAmount = '//tr[@id="table_cartItem_%s"]/td[4]';
    public string $basketUpdateButton = '#basketcontents_table #basketUpdate';
    public string $addBasketCouponField = '#input_voucherNr';
    public string $addBasketCouponButton = '//div[@id="basketVoucher"]//button';
    public string $removeBasketCoupon = '.couponData .removeFn';
    public string $openGiftSelection = '//tr[@id="table_cartItem_%s"]/td[3]/a';
    public string $basketItemAttributes = '#table_cartItem_%s';
    public string $basketItemSelection = '//div[@id="cartItemSelections_%s"]/div';

    public function updateProductAmount(float $amount, int $itemPosition = 1): self
    {
        $I = $this->user;
        $I->fillField(sprintf($this->basketItemAmount, $itemPosition), $amount);
        $I->click($this->basketUpdateButton);
        return $this;
    }

    /**
     * $basketProducts[] = ['id' => productId,
     *                   'title' => productTitle,
     *                   'amount' => productAmount,
     *                   'totalPrice' => productTotalPrice]
     */
    public function seeBasketContains(array $basketProducts, string $basketSummaryPrice): self
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
        $I->see($basketSummaryPrice, $this->basketSummary);
        return $this;
    }

    /**
     * $basketProduct = ['id' => productId,
     *                   'title' => productTitle,
     *                   'amount' => productAmount]
     */
    public function seeBasketContainsBundledProduct(array $basketProduct, int $itemPosition): self
    {
        $I = $this->user;
        $I->see(Translator::translate('PRODUCT_NO') .
            ' ' . $basketProduct['id'], sprintf($this->basketItemId, $itemPosition));
        $I->see($basketProduct['title'], sprintf($this->basketItemTitle, $itemPosition));
        $I->see($basketProduct['amount'], sprintf($this->basketBundledItemAmount, $itemPosition));
        return $this;
    }

    public function seeBasketContainsAttribute(string $basketProductAttribute, int $itemPosition): self
    {
        $this->user->see($basketProductAttribute, sprintf($this->basketItemAttributes, $itemPosition));
        return $this;
    }

    public function seeBasketContainsSelectionList(string $selectionListTitle, string $selectionListValue, int $itemPosition): self
    {
        $this->user->see($selectionListTitle . ': ' . $selectionListValue, sprintf($this->basketItemSelection, $itemPosition));
        return $this;
    }

    public function goToNextStep(): UserCheckout
    {
        $I = $this->user;
        $I->click(Translator::translate('CONTINUE_TO_NEXT_STEP'));
        $I->waitForElement($this->breadCrumb);
        return new UserCheckout($I);
    }

    public function seeNextStep(): self
    {
        $this->user->see(Translator::translate('CONTINUE_TO_NEXT_STEP'));
        return $this;
    }

    public function dontSeeNextStep(): self
    {
        $this->user->dontSee(Translator::translate('CONTINUE_TO_NEXT_STEP'));
        return $this;
    }

    public function addCouponToBasket(string $couponNumber): self
    {
        $I = $this->user;
        $I->fillField($this->addBasketCouponField, $couponNumber);
        $I->click($this->addBasketCouponButton);
        $I->waitForElementVisible('.couponData');
        return $this;
    }

    public function removeCouponFromBasket(): self
    {
        $this->user->click($this->removeBasketCoupon);
        return $this;
    }

    public function openGiftSelection(int $itemPosition): GiftSelection
    {
        $I = $this->user;
        $I->retryClick(sprintf($this->openGiftSelection, $itemPosition));
        $I->waitForText(Translator::translate('GIFT_OPTION'));
        return new GiftSelection($I);
    }
}
