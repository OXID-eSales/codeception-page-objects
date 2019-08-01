<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Step;

use OxidEsales\Codeception\Page\Checkout\UserCheckout;
use OxidEsales\Codeception\Page\Checkout\Basket as BasketPage;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;

/**
 * Class Basket
 * @package OxidEsales\Codeception\Step
 */
class Basket extends Step
{
    use MiniBasket;

    /**
     * Add product to the basket without any redirects
     *
     * This method requires existing of name='stoken' element to present in Currently loaded page.
     *
     * @param string $productId
     * @param int    $amount
     */
    public function addProductToBasket(string $productId, int $amount)
    {
        $I = $this->user;
        //add Product to basket
        // $params['cl'] = $controller;
        $params['fnc'] = 'tobasket';
        $params['aid'] = $productId;
        $params['am'] = $amount;
        $params['anid'] = $productId;

        if ($I->seePageHasElement('input[name=stoken]')) {
            $params['stoken'] = $I->grabValueFrom('input[name=stoken]');
        }

        $I->amOnPage('/index.php?'.http_build_query($params));
        $I->waitForElement($this->miniBasketMenuElement);
        $I->waitForPageLoad();
    }

    /**
     * Add product to the basket and open given controller:
     * 'user' for  UserCheckout page, else opens Basket page.
     *
     * This method requires existing of name='stoken' element to present in Currently loaded page.
     *
     * @param string $productId
     * @param int    $amount
     * @param string $controller
     *
     * @return BasketPage|UserCheckout
     */
    public function addProductToBasketAndOpen(string $productId, int $amount, string $controller)
    {
        $I = $this->user;

        //add Product to basket
        $params['cl'] = $controller;
        $params['fnc'] = 'tobasket';
        $params['aid'] = $productId;
        $params['am'] = $amount;
        $params['anid'] = $productId;

        if ($I->seePageHasElement('input[name=stoken]')) {
            $params['stoken'] = $I->grabValueFrom('input[name=stoken]');
        }

        $I->amOnPage('/index.php?'.http_build_query($params));
        if ($controller === 'user') {
            $userCheckoutPage = new UserCheckout($I);
            $breadCrumbName = Translator::translate("ADDRESS");
            $userCheckoutPage->seeOnBreadCrumb($breadCrumbName);
            return $userCheckoutPage;
        } else {
            $basketPage = new BasketPage($I);
            $breadCrumbName = Translator::translate("CART");
            $basketPage->seeOnBreadCrumb($breadCrumbName);
            return $basketPage;
        }
    }
}
