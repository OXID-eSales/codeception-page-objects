<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Details;

use OxidEsales\Codeception\Page\Account\UserLogin;
use OxidEsales\Codeception\Page\Component\Footer\ServiceWidget;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\LanguageMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Component\Header\Navigation;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Lists\ProductSearchList;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for the product details page
 * @package OxidEsales\Codeception\Page\Details
 */
class ProductDetails extends Page
{
    use AccountMenu;
    use LanguageMenu;
    use MiniBasket;
    use Navigation;
    use ServiceWidget;

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $nextProductLink = '#linkNextArticle';

    public $previousProductLink = '#linkPrevArticle';

    public $productTitle = '#productTitle';

    public $productShortDesc = '#productShortdesc';

    public $productArtNum = '';

    public $productOldPrice = '.price-old';

    public $productPrice = '#productPrice';

    public $productPricePlus = '//div[@class="price-wrapper h1"]/div[@class="vat-info-text"]';

    public $productUnitPrice = '.ppu';

    public $toBasketButton = '#toBasket';

    public $basketAmountField = '#amountToBasket';

    public $addToCompareListLink = '#addToCompare';

    public $removeFromCompareListLink = '#removeFromCompare';

    public $addToWishListLink = '#linkToNoticeList';

    public $addToGiftRegistryLink = '#linkToWishList';

    public $reviewLoginLink = '//div[@id="review"]//a';

    public $openReviewForm = '//div[@id="review"]//a';

    public $reviewTextForm = '[name=rvw_txt]';

    public $ratingSelection = '//ul[@id="reviewRating"]/li[%s]';

    public $saveRatingAndReviewButton = '#reviewSave';

    public $productReviewAuthor = '//div[@id="reviewName_%s"]//div[@class="rater"]/span';

    public $productReviewText = '#reviewText_%s';

    public $userProductRating = '//div[@id="reviewName_%s"]/div/div/*[@class="star active"]';

    public $productSuggestionLink = '#suggest';

    public $priceAlertEmail = 'pa[email]';

    public $priceAlertSuggestedPrice = 'pa[price]';

    public $accessoriesProductTitle = '//div[@id="accessories"]/div/div[%s]//div[@class="h5 card-title"]';

    public $accessoriesProductPrice = '//div[@id="accessories"]/div/div[%s]//div[contains(@class,"price")]';
    public $openAccessoriesProduct = '//div[@id="accessories"]/div/div[%s]';
    public $similarProductTitle = '//div[@id="similar"]/div/div[%s]//div[@class="h5 card-title"]';

    public $similarProductPrice = '//div[@id="similar"]/div/div[%s]//div[contains(@class,"price")]';
    public $openSimilarProduct = '//div[@id="similar"]/div/div[%s]';

    public $crossSellingProductTitle = '//div[@id="cross"]/div/div[%s]//div[@class="h5 card-title"]';

    public $crossSellingProductPrice = '//div[@id="cross"]/div/div[%s]//div[contains(@class,"price")]';
    public $openCrossSellingProduct = '//div[@id="cross"]/div/div[%s]';

    public $disabledBasketButton = '//button[@id="toBasket" and @disabled=""]';

    public $variantSelection = '//div[@id="variants"]/div[%s]/select';

    public $variantOpenSelection = '//ul[@class="dropdown-menu  vardrop"]';

    public $amountPriceQuantity = '//div[@class="modal-content"]/div[2]/dl/dt[%s]';

    public $amountPriceValue = '//div[@class="modal-content"]/div[2]/dl/dd[%s]';

    public $amountPriceCloseButton = '//div[@class="modal fade show"]//button';

    public $selectionList = '#productSelections select';

    public $attributeName = '#attrTitle_%s';

    public $attributeValue = '#attrValue_%s';

    public $addToListmania = '#recommList';

    /**
     * Return the route to the product details page
     *
     * @param mixed $param The product Id.
     *
     * @return string
     */
    public function route($param)
    {
        return $this->URL . '/index.php?' . http_build_query(['cl' => 'details', 'anid' => $param]);
    }

    /**
     * Assert if user cannot buy current product
     *
     * @return $this
     */
    public function checkIfProductIsNotBuyable()
    {
        $I = $this->user;
        $I->seeElement($this->disabledBasketButton);
        return $this;
    }

    /**
     * Assert if user can buy current product
     *
     * @return $this
     */
    public function checkIfProductIsBuyable()
    {
        $I = $this->user;
        $I->dontSeeElement($this->disabledBasketButton);
        return $this;
    }

    /**
     * @param int    $variant      The position of the variant.
     * @param string $variantValue The value of the variant.
     * @param string $waitForText  The text to wait (optional).
     *
     * @return $this
     */
    public function selectVariant(int $variant, string $variantValue, string $waitForText = '')
    {
        $I = $this->user;
        $I->selectOption(sprintf($this->variantSelection, $variant), $variantValue);
        $I->waitForElementNotVisible($this->variantOpenSelection);
        $I->waitForPageLoad();
        $I->waitForText($variantValue);
        $I->wait(1);
        return $this;
    }

    /**
     * @param int    $variant      The position of the variant.
     * @param string $variantValue The value of the variant.
     *
     * @return $this
     */
    public function seeVariant(int $variant, string $variantValue)
    {
        $I = $this->user;
        $I->click(sprintf($this->variantSelection, $variant));
        $I->see($variantValue);
        $I->click(sprintf($this->variantSelection, $variant));
        return $this;
    }

    /**
     * @param int    $variant      The position of the variant.
     * @param string $variantValue The value of the variant.
     *
     * @return $this
     */
    public function dontSeeVariant(int $variant, string $variantValue)
    {
        $I = $this->user;
        $I->click(sprintf($this->variantSelection, $variant));
        $I->dontSee($variantValue);
        $I->click(sprintf($this->variantSelection, $variant));
        return $this;
    }

    /**
     * @return $this
     */
    public function addToCompareList()
    {
        $I = $this->user;
        $I->waitForElementClickable($this->addToCompareListLink);
        $I->click($this->addToCompareListLink);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @return $this
     */
    public function removeFromCompareList()
    {
        $I = $this->user;
        $I->click($this->removeFromCompareListLink);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @return $this
     */
    public function addToWishList()
    {
        $I = $this->user;
        $I->waitForElementClickable($this->addToWishListLink);
        $I->retryClick($this->addToWishListLink);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @return ProductListmania
     */
    public function addToListmania()
    {
        $I = $this->user;
        $I->waitForElementClickable($this->addToListmania);
        $I->click($this->addToListmania);
        $I->waitForPageLoad();
        return new ProductListmania($I);
    }

    /**
     * @return $this
     */
    public function addProductToGiftRegistryList()
    {
        $I = $this->user;
        $I->waitForElementClickable($this->addToGiftRegistryLink);
        $I->click($this->addToGiftRegistryLink);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @param string $userName
     * @param string $userPassword
     *
     * @return $this
     */
    public function loginUserForReview(string $userName, string $userPassword)
    {
        $I = $this->user;
        $I->retryClick($this->reviewLoginLink);
        $userLoginPage = new UserLogin($I);
        $I->see(Translator::translate('LOGIN'));
        $userLoginPage->login($userName, $userPassword);
        return $this;
    }

    /**
     * @param string $review
     * @param int    $rating
     *
     * @return $this
     */
    public function addReviewAndRating(string $review, int $rating)
    {
        $I = $this->user;
        $I->retryClick($this->openReviewForm);
        $I->waitForElement($this->reviewTextForm);
        $I->fillField($this->reviewTextForm, $review);
        $I->retryClick(sprintf($this->ratingSelection, $rating));
        $I->retryClick($this->saveRatingAndReviewButton);
        return $this;
    }

    /**
     * @param int    $reviewId The position of the review item.
     * @param string $userName
     * @param string $reviewText
     * @param int    $rating
     *
     * @return $this
     */
    public function seeUserProductReviewAndRating(int $reviewId, string $userName, string $reviewText, int $rating)
    {
        $I = $this->user;
        $I->see($userName, sprintf($this->productReviewAuthor, $reviewId));
        $I->see($reviewText, sprintf($this->productReviewText, $reviewId));
        $I->seeNumberOfElements(sprintf($this->userProductRating, $reviewId), $rating);
        return $this;
    }

    /**
     * Opens recommend page.
     *
     * @return ProductSuggestion
     */
    public function openProductSuggestionPage()
    {
        $I = $this->user;
        $I->click($this->productSuggestionLink);
        $productSuggestionPage = new ProductSuggestion($I);
        $breadCrumb = Translator::translate('RECOMMEND_PRODUCT');
        $productSuggestionPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('RECOMMEND_PRODUCT'), $productSuggestionPage->headerTitle);
        return $productSuggestionPage;
    }

    /**
     * @param string $email
     * @param float  $price
     *
     * @return $this
     */
    public function sendPriceAlert(string $email, float $price)
    {
        $I = $this->user;
        $this->openPriceAlert();
        $I->fillField($this->priceAlertEmail, $email);
        $I->fillField($this->priceAlertSuggestedPrice, $price);
        $I->click(Translator::translate('SEND'));
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * Opens price alert tab.
     *
     * @return $this
     */
    public function openPriceAlert()
    {
        $I = $this->user;
        $I->click(Translator::translate('PRICE_ALERT'));
        $I->see(Translator::translate('MESSAGE_PRICE_ALARM_PRICE_CHANGE'));
        return $this;
    }

    /**
     * Opens attribute tab.
     *
     * @return $this
     */
    public function openAttributes()
    {
        //is alredy open
        return $this;
    }

    /**
     * Opens description tab.
     *
     * @return $this
     */
    public function openDescription()
    {
        //is alredy open
        return $this;
    }

    /**
     * Check product data is displayed correctly.
     * $productData = ['title', 'description', 'id', 'price']
     *
     * @param array $productData
     *
     * @return $this
     */
    public function seeProductData(array $productData)
    {
        $I = $this->user;
        $I->waitForElement($this->productTitle);
        $I->waitForText($productData['title'], 30, $this->productTitle);
        $I->see($productData['title'], $this->productTitle);
        $I->see($productData['description'], $this->productShortDesc);
        $I->see($productData['id']);
        $I->see($productData['price'], $this->productPrice);
        $I->see(Translator::translate('PLUS_SHIPPING'), $this->productPricePlus);
        return $this;
    }

    /**
     * @param string $price
     *
     * @return $this
     */
    public function seeProductOldPrice(string $price)
    {
        $I = $this->user;
        $I->see($price, $this->productOldPrice);
        return $this;
    }

    /**
     * @param string $price
     *
     * @return $this
     */
    public function seeProductUnitPrice(string $price)
    {
        $I = $this->user;
        $I->see($price, $this->productUnitPrice);
        return $this;
    }

    /**
     * Add current product to basket
     *
     * @param int $amount
     *
     * @return $this
     */
    public function addProductToBasket(int $amount = 1)
    {
        $I = $this->user;
        $I->fillField($this->basketAmountField, $amount);
        $I->click($this->toBasketButton);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * Check the data of the accessory product.
     * $productData = ['title', 'price']
     *
     * @param array $productData The product data to check.
     * @param int   $position    The position of the product in the list.
     *
     * @return $this
     */
    public function seeAccessoryData(array $productData, int $position = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf($this->accessoriesProductTitle, $position));
        $I->see($productData['price'], sprintf($this->accessoriesProductPrice, $position));
        return $this;
    }

    /**
     * @param int $position The position of the product in the list.
     *
     * @return $this
     */
    public function openAccessoryDetailsPage(int $position = 1)
    {
        $I = $this->user;
        $I->retryClick(sprintf($this->openAccessoriesProduct, $position));
        $I->waitForPageLoad();
        $I->waitForElement($this->productTitle);
        return $this;
    }

    /**
     * Check the data of the similar product.
     * $productData = ['title', 'price']
     *
     * @param array $productData The product data to check.
     * @param int   $position    The position of the product in the list.
     *
     * @return $this
     */
    public function seeSimilarProductData(array $productData, int $position = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf($this->similarProductTitle, $position));
        $I->see($productData['price'], sprintf($this->similarProductPrice, $position));
        return $this;
    }

    /**
     * @param int $position The position of the product in the list.
     *
     * @return $this
     */
    public function openSimilarProductDetailsPage(int $position = 1)
    {
        $I = $this->user;
        $I->retryClick(sprintf($this->openSimilarProduct, $position));
        $I->waitForPageLoad();
        $I->waitForElement($this->productTitle);
        return $this;
    }

    /**
     * Check the data of the cross selling product.
     * $productData = ['title', 'price']
     *
     * @param array $productData The product data to check.
     * @param int   $position    The position of the product in the list.
     *
     * @return $this
     */
    public function seeCrossSellingData(array $productData, int $position = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf($this->crossSellingProductTitle, $position));
        $I->see($productData['price'], sprintf($this->crossSellingProductPrice, $position));
        return $this;
    }

    /**
     * @param int $position The position of the product in the list.
     *
     * @return $this
     */
    public function openCrossSellingDetailsPage(int $position = 1)
    {
        $I = $this->user;
        $I->retryClick(sprintf($this->openCrossSellingProduct, $position));
        $I->waitForPageLoad();
        $I->waitForElement($this->productTitle);
        return $this;
    }

    /**
     * Check the amount prices of the product.
     * $amountPrices[] = [
     * 'amountFrom',
     * 'discount'
     * ]
     *
     * @param array $amountPrices
     *
     * @return $this
     */
    public function seeAmountPrices(array $amountPrices)
    {
        $I = $this->user;
        $I->click(Translator::translate('BLOCK_PRICE'));
        $I->waitForElementVisible(sprintf($this->amountPriceQuantity, 1));
        $itemPosition = 1;
        foreach ($amountPrices as $amountPrice) {
            $fromAmount = Translator::translate('FROM')
                . ' ' . $amountPrice['amountFrom']
                . ' ' . Translator::translate('PCS');
            $discountText = $amountPrice['discount'] . '% ' . Translator::translate('DISCOUNT');
            $I->see($fromAmount, sprintf($this->amountPriceQuantity, $itemPosition));
            $I->see($discountText, sprintf($this->amountPriceValue, $itemPosition));
            $itemPosition++;
        }
        $I->click($this->amountPriceCloseButton);
        return $this;
    }

    /**
     * @return $this
     */
    public function openNextProduct()
    {
        $I = $this->user;
        $I->click($this->nextProductLink);
        return $this;
    }

    /**
     * @return $this
     */
    public function openPreviousProduct()
    {
        $I = $this->user;
        $I->click($this->previousProductLink);
        return $this;
    }

    /**
     * @return ProductSearchList
     */
    public function openProductSearchList()
    {
        $I = $this->user;
        $I->click(Translator::translate('BACK_TO_OVERVIEW'));
        return new ProductSearchList($I);
    }

    /**
     * @param string $selectionItem
     * @return $this
     */
    public function selectSelectionListItem(string $selectionItem)
    {
        $I = $this->user;
        $I->selectOption($this->selectionList, $selectionItem);
        $I->see($selectionItem, $this->selectionList);
        return $this;
    }

    /**
     * @param string $attributeName
     * @param int    $attributeId
     *
     * @return $this
     */
    public function seeAttributeName(string $attributeName, int $attributeId)
    {
        $I = $this->user;
        $I->see($attributeName, sprintf($this->attributeName, $attributeId));
        return $this;
    }

    /**
     * @param string $attributeValue
     * @param int    $attributeId
     *
     * @return $this
     */
    public function seeAttributeValue(string $attributeValue, int $attributeId)
    {
        $I = $this->user;
        $I->see($attributeValue, sprintf($this->attributeValue, $attributeId));
        return $this;
    }
}
