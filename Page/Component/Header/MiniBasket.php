<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Header;

use OxidEsales\Codeception\Module\Context;
use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Page\Checkout\PaymentCheckout;
use OxidEsales\Codeception\Page\Checkout\UserCheckout;
use OxidEsales\Codeception\Module\Translation\Translator;

trait MiniBasket
{
    public string $miniBasketMenuElement = '//div[@class="btn-group minibasket-menu"]/button';
    public string $miniBasketTitle = '//div[@class="minibasket-menu-box"]/p';
    public string $miniBasketItemTitle = '//div[@id="basketFlyout"]/table/tbody/tr[%d]/td[2]/a';
    public string $miniBasketItemAmount = '//div[@id="basketFlyout"]/table/tbody/tr[%d]/td[1]/span';
    public string $miniBasketItemPrice = '//div[@id="basketFlyout"]/table/tbody/tr[%d]/td[3]';
    public string $miniBasketSummaryPrice = '//td[@class="total_price text-right"]';
    public string $miniBasketCountDown = '#countdown';
    public string $miniBasketClose = '//div[@class="btn-group minibasket-menu open"]/button';

    /**
     * $basketProducts[] = ['title' => productTitle,
     *                   'price' => productPrice,
     *                   'amount' => productAmount,]
     */
    public function seeMiniBasketContains(array $basketProducts, string $basketSummaryPrice, string $totalAmount): self
    {
        $I = $this->user;
        $this->openMiniBasket();
        $I->see(sprintf('%s %s', $totalAmount, Translator::translate('ITEMS_IN_BASKET')));
        foreach ($basketProducts as $key => $basketProduct) {
            $itemPosition = (string)++$key;
            $I->see($basketProduct['title'], $I->clearString(sprintf($this->miniBasketItemTitle, $itemPosition)));
            $I->see((string)($basketProduct['amount']), sprintf($this->miniBasketItemAmount, $itemPosition));
            $I->see((string)$basketProduct['price'], sprintf($this->miniBasketItemPrice, $itemPosition));
        }
        $I->see($basketSummaryPrice, $this->miniBasketSummaryPrice);
        return $this;
    }

    public function openMiniBasket(): self
    {
        $I = $this->user;
        $I->waitForPageLoad();
        $I->waitForElementClickable($this->miniBasketMenuElement);
        $I->click($this->miniBasketMenuElement);
        $I->waitForText(Translator::translate('DISPLAY_BASKET'));
        return $this;
    }

    public function closeMiniBasket(): self
    {
        $I = $this->user;
        $I->waitForElementClickable($this->miniBasketClose);
        $I->click($this->miniBasketClose);
        $I->waitForElementNotVisible($this->miniBasketTitle);
        return $this;
    }

    public function openCheckout(): UserCheckout|PaymentCheckout
    {
        $I = $this->user;
        $I->waitForText(Translator::translate('CHECKOUT'));
        $I->click(Translator::translate('CHECKOUT'));
        $I->waitForPageLoad();
        if (Context::isUserLoggedIn()) {
            return new PaymentCheckout($I);
        } else {
            return new UserCheckout($I);
        }
    }

    public function openBasketDisplay(): Basket
    {
        $I = $this->user;
        $I->click(Translator::translate('DISPLAY_BASKET'));
        $I->see(Translator::translate('CART'));
        return new Basket($I);
    }

    public function checkBasketEmpty(): self
    {
        $I = $this->user;
        $I->click($this->miniBasketMenuElement);
        $I->see(Translator::translate('BASKET_EMPTY'));
        return $this;
    }

    public function seeCountdownWithinBasket(): self
    {
        $I = $this->user;
        $I->click($this->miniBasketMenuElement);
        $I->seeElement($this->miniBasketCountDown);
        return $this;
    }
}
