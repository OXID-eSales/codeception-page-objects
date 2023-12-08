<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Component\PaymentSummary;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for gift options page
 *
 * @package OxidEsales\Codeception\Page\Checkout
 */
class GiftSelection extends Page
{
    use PaymentSummary;

    public $selectWrapping = '//div[@id="swiper-basketproduct-%s"]//div[@id="wrap_%s_%s"]';

    public $waitforGiftCard = '//div[@id="wrappCard"]//input[@id="chosen_%s"]';

    public $selectGiftCard = '//div[@id="wrappCard"]//input[@id="chosen_%s"]/following-sibling::label';

    public $greetingsTextField = '#giftmessage';

    public $submitChangesButton = '';

    /**
     * Select a wrapping with given id.
     *
     * @param int    $itemPosition The position of basket item.
     * @param string $wrappingId   The id of wrapping.
     *
     * @return $this
     */
    public function selectWrapping(int $itemPosition, string $wrappingId)
    {
        $I = $this->user;
        $I->retryClick(Translator::translate('ADD_WRAPPING'));
        $I->waitForElementClickable(sprintf($this->selectWrapping, $itemPosition, $itemPosition, $wrappingId));
        $I->wait(1);
        $I->click(sprintf($this->selectWrapping, $itemPosition, $itemPosition, $wrappingId));
        return $this;
    }

    /**
     * Select a gift card with given id.
     *
     * @param string $cardId The gift card id
     *
     * @return $this
     */
    public function selectCard(string $cardId)
    {
        $I = $this->user;
        $I->retryClick(Translator::translate('GREETING_CARD'));
        $I->waitForElementCLickable(sprintf($this->waitforGiftCard, $cardId));
        $I->wait(1);
        $I->click(sprintf($this->selectGiftCard, $cardId));
        return $this;
    }

    /**
     * Add a greeting message.
     *
     * @param string $message
     *
     * @return $this
     */
    public function addGreetingMessage(string $message)
    {
        $I = $this->user;
        $I->fillField($this->greetingsTextField, $message);
        return $this;
    }

    /**
     * Submit changes made in this page and continue with checkout.
     *
     * @return Basket
     */
    public function submitChanges(): Basket
    {
        $I = $this->user;
        $basketPage = new Basket($I);
        $I->click(Translator::translate('APPLY'));
        $I->waitForText(Translator::translate('CART'));
        return $basketPage;
    }
}
