<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class ProductsOrderPage extends Page
{
    use OrderList;

    public string $searchFieldInProductTab = 'sSearchArtNum';
    public string $searchButtonInProductTab = '//input[@name="search"]';
    public string $addButtonInProductTab = '//input[@name="add"]';
    public string $secondProductInProductTab = '#art.2';
    private string $orderProductLabel = '#art\.%d td:nth-of-type(5)';

    public function addANewProductToTheOrder(string $articleNumber): self
    {
        $I = $this->user;

        $I->fillField($this->searchFieldInProductTab, $articleNumber);
        $I->clickAndWait($this->searchButtonInProductTab);
        $I->waitForElementClickable($this->addButtonInProductTab);
        $I->clickAndWait($this->addButtonInProductTab);

        return $this;
    }

    public function seeOrderProductLabel(string $label, int $product): static
    {
        $I = $this->user;
        $I->seeText(
            sprintf('%s: %s', Translator::translate('GENERAL_LABEL'), $label),
            sprintf($this->orderProductLabel, $product)
        );
        return $this;
    }

    public function dontSeeOrderProductHasLabel(int $product): static
    {
        $I = $this->user;
        $I->dontSee(
            Translator::translate('GENERAL_LABEL'),
            sprintf($this->orderProductLabel, $product)
        );
        return $this;
    }
}
