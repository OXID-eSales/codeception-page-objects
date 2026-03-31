<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Lists;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Component\Header\SearchWidget;
use OxidEsales\Codeception\Page\Details\ProductDetails;

/**
 * @package OxidEsales\Codeception\Page\Lists
 */
class ProductSearchList extends ProductList
{
    use SearchWidget;

    private string $listItem = '//div[@id="searchList"]/div/div[%s]';
    public string $listItemImage = '(//div[@id="searchList"]/div/div[%s]//img[contains(@class,"product-img")])[%s]';
    private string $lineListItemImage = '//div[@id="searchList"]/div/div[%s]//img[contains(@class,"card-img")]';
    public string $listItemTitle = '//div[@id="searchList"]/div/div[%s]//*[@class="h5 card-title"]';
    public string $listItemDescription = '//div[@id="searchList"]/div/div[%s]//div[@class="short-desc"]';
    public string $listItemPrice = '//div[@id="searchList"]/div/div[%s]//div[contains(@class,"price")]/span';
    public string $listItemDescriptionTypeList = '//div[@id="searchList"]/div/div[%s]//div[@class="card-text"]';
    public string $listItemForm = '//form[@name="tobasketsearchList_%s"]';
    public string $variantSelection = '#variantselector_searchList_%s button';
    public string $product = '(//div[@class="card product-card"])[%s]';

    public function route(mixed $params): string
    {
        return $this->URL . '/index.php?' . http_build_query(['cl' => 'search', 'searchparam' => $params]);
    }

    public function seeSearchCount(int $count): static
    {
        $I = $this->user;
        $I->seeText($count . ' ' . Translator::translate('HITS_FOR'));
        return $this;
    }

    public function seeLineListPictureAltText(string $altText, int $itemPosition = 1): static
    {
        $I = $this->user;
        $I->seeElement(
            sprintf(
                '%s[@alt="%s"]',
                sprintf($this->lineListItemImage, $itemPosition),
                $altText
            )
        );

        return $this;
    }

    public function openProduct(int $position = 1): ProductDetails
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->product, $position));
        return new ProductDetails($I);
    }

    public function openFirstProductInSearchResults(): ProductDetails
    {
        $I = $this->user;
        $firstProductsTitle = sprintf($this->listItem, 1);
        $I->clickAndWait($firstProductsTitle);

        return new ProductDetails($I);
    }
}
