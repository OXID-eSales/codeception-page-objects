<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Widget;

use Codeception\Actor;
use OxidEsales\Codeception\Page\Page;

use function sprintf;
use function sprintf as sprintf1;

class ProductCard extends Page
{
    private int $position;
    private string $widgetId;

    private string $productSelector = "//*[@id='%s']/div[%d]";
    private string $productTitleSelector = "//div[@id='%s']/div[%d]/div[2]/div[1]//*[@class='h5 card-title']";
    private string $addToCartButton = "//*[@id='submit%s_%d']";
    private string $productAmountSelector = "input[aria-describedby='submit%s_%d']";
    private string $detailsButton = "//*[@id='%s']/div/div[%d]/div/div[1]/a";

    public function __construct(Actor $I, string $widgetId, int $position)
    {
        $this->position = $position;
        $this->widgetId = $widgetId;
        parent::__construct($I);
    }

    public function productHasTitle(string $productName): self
    {
        $I = $this->user;
        $I->seeText(
            $productName,
            sprintf1($this->productTitleSelector, $this->widgetId, $this->position)
        );

        return $this;
    }

    public function setProductAmount(int $amount): self
    {
        $I = $this->user;
        $productAmountLocator = sprintf(
            $this->productAmountSelector,
            $this->widgetId,
            $this->position
        );
        $I->waitForElementVisible($productAmountLocator);
        $I->clickAndWait($productAmountLocator);
        $I->fillField(
            $productAmountLocator,
            $amount
        );
        return $this;
    }

    public function addProductToCart(): self
    {
        $I = $this->user;
        $I->clickAndWait(
            sprintf($this->addToCartButton, $this->widgetId, $this->position)
        );

        return $this;
    }

    public function openProductDetails(): self
    {
        $I = $this->user;
        $I->clickAndWait(
            sprintf($this->detailsButton, $this->widgetId, $this->position)
        );

        return $this;
    }
}
