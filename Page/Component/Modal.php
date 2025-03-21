<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component;

use Codeception\Util\Locator;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Checkout\Basket;

trait Modal
{
    public string $modalCloseBtn = '.modal-dialog .modal-content button.close';
    private string $confirmDeletionBtn = '.modal-dialog .modal-content button.btn-danger';
    private string $deleteShippingAddressBtn = '//*[@id="delete_shipping_address_%s"]/div/div/div[3]/button[2]';
    private string $rootCatChangedModal = '#scRootCatChanged';
    private string $rootCatChangedConfirmation = '.modal-footer';

    public function confirmDeletion(): void
    {
        $I = $this->user;
        $I->waitForElementClickable($this->confirmDeletionBtn);
        $I->clickAndWait(
            Locator::contains($this->confirmDeletionBtn, Translator::translate('DD_DELETE'))
        );
    }

    public function confirmShippingAddressDeletion($position): void
    {
        $I = $this->user;
        $button = sprintf($this->deleteShippingAddressBtn, $position);
        $I->waitForElementClickable($button);
        $I->clickAndWait(
            Locator::contains($button, Translator::translate('DD_DELETE'))
        );
    }

    public function closeModalBox(): void
    {
        $I = $this->user;
        $I->waitForElementClickable($this->modalCloseBtn);
        $I->clickAndWait($this->modalCloseBtn);
    }

    //Only for private sales
    public function confirmMainCategoryChanged(): self
    {
        $I = $this->user;
        $I->seeText(Translator::translate('ROOT_CATEGORY_CHANGED'));
        $I->clickAndWait(Translator::translate('CONTINUE_SHOPPING'));

        return $this;
    }

    //Only for private sales
    public function openBasketIfMainCategoryChanged(): Basket
    {
        $I = $this->user;
        $I->seeText(Translator::translate('ROOT_CATEGORY_CHANGED'));
        $I->clickAndWait(Translator::translate('CHECKOUT'), $this->rootCatChangedConfirmation);

        return new Basket($I);
    }
}
