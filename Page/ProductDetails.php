<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page;

use OxidEsales\Codeception\Page\Account\UserLogin;
use OxidEsales\Codeception\Page\Footer\ServiceWidget;
use OxidEsales\Codeception\Page\Header\AccountMenu;
use OxidEsales\Codeception\Page\Header\LanguageMenu;
use OxidEsales\Codeception\Page\Header\MiniBasket;
use OxidEsales\Codeception\Page\Header\Navigation;
use OxidEsales\Codeception\Module\Translation\Translator;

class ProductDetails extends Page
{
    use AccountMenu, LanguageMenu, MiniBasket, Navigation, ServiceWidget;

    // include url of current page
    public static $URL = '';

    // include bread crumb of current page
    public static $breadCrumb = '#breadcrumb';

    public static $nextProductLink = '#linkNextArticle';

    public static $previousProductLink = '#linkPrevArticle';

    public static $productTitle = '#productTitle';

    public static $productShortDesc = '#productShortdesc';

    public static $productArtNum = '';

    public static $productOldPrice = '.pricebox del';

    public static $productPrice = '#productPrice';

    public static $productUnitPrice = '#productPriceUnit';

    public static $toBasketButton = '#toBasket';

    public static $basketAmountField = '#amountToBasket';

    public static $addToCompareListLink = '#addToCompare';

    public static $addToWishListLink = '#linkToNoticeList';

    public static $addToGiftRegistryLink = '#linkToWishList';

    public static $reviewLoginLink = '#reviewsLogin';

    public static $openReviewForm = '#writeNewReview';

    public static $reviewTextForm = 'rvw_txt';

    public static $ratingSelection = '//ul[@id="reviewRating"]/li[%s]';

    public static $saveRatingAndReviewButton = '#reviewSave';

    public static $productReviewAuthor = '//div[@id="reviewName_%s"]/div[2]/div/div[1]/span[1]';

    public static $productReviewText = '#reviewText_%s';

    public static $userProductRating = '//div[@id="reviewName_%s"]/div[2]/div/div[2]/div[1]/i[@class="fas fa-star"]';

    public static $productSuggestionLink = '#suggest';

    public static $priceAlertEmail = 'pa[email]';

    public static $priceAlertSuggestedPrice = 'pa[price]';

    public static $accessoriesProductTitle = '#accessories_%s';

    public static $accessoriesProductPrice = '//form[@name="tobasketaccessories_%s"]/div/div[@class="price text-center"]';

    public static $similarProductTitle = '#similar_%s';

    public static $similarProductPrice = '//form[@name="tobasketsimilar_%s"]/div/div[@class="price text-center"]';

    public static $crossSellingProductTitle = '#cross_%s';

    public static $crossSellingProductPrice = '//form[@name="tobasketcross_%s"]/div/div[@class="price text-center"]';

    public static $disabledBasketButton = '//button[@id="toBasket" and @disabled="disabled"]';

    public static $variantSelection = '//div[@id="variants"]/div[%s]//button';

    public static $amountPriceQuantity = '//div[@class="modal-content"]/div[2]/dl/dt[%s]';

    public static $amountPriceValue = '//div[@class="modal-content"]/div[2]/dl/dd[%s]';

    public static $amountPriceCloseButton = '//div[@class="modal-content"]/div[3]/button';

    public static $selectionList = '#productSelections button';

    public static $attributeName = '#attrTitle_%s';

    public static $attributeValue = '#attrValue_%s';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.'/index.php?'.http_build_query(['cl' => 'details', 'anid' => $param]);
    }

    /**
     * Assert if user cannot buy current product
     *
     * @return $this
     */
    public function checkIfProductIsNotBuyable()
    {
        $I = $this->user;
        $I->seeElement(self::$disabledBasketButton);
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
        $I->dontSeeElement(self::$disabledBasketButton);
        return $this;
    }

    /**
     * @param int    $variant
     * @param string $variantValue
     * @param string $waitForText
     *
     * @return $this
     */
    public function selectVariant($variant, $variantValue, $waitForText = null)
    {
        $I = $this->user;
        $I->click(sprintf(self::$variantSelection, $variant));
        $I->click($variantValue);
        $I->waitForPageLoad();
        $I->see($variantValue);
        return $this;
    }

    /**
     * @param int    $variant
     * @param string $variantValue
     *
     * @return $this
     */
    public function seeVariant($variant, $variantValue)
    {
        $I = $this->user;
        $I->click(sprintf(self::$variantSelection, $variant));
        $I->see($variantValue);
        $I->click(sprintf(self::$variantSelection, $variant));
        return $this;
    }

    /**
     * @param int    $variant
     * @param string $variantValue
     *
     * @return $this
     */
    public function dontSeeVariant($variant, $variantValue)
    {
        $I = $this->user;
        $I->click(sprintf(self::$variantSelection, $variant));
        $I->dontSee($variantValue);
        $I->click(sprintf(self::$variantSelection, $variant));
        return $this;
    }

    /**
     * @return $this
     */
    public function addToCompareList()
    {
        $I = $this->user;
        $I->click(self::$addToCompareListLink);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @return $this
     */
    public function removeFromCompareList()
    {
        $I = $this->user;
        //TODO: not like in azure
        $I->click(self::$addToCompareListLink);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @return $this
     */
    public function addToWishList()
    {
        $I = $this->user;
        $I->click(self::$addToWishListLink);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @return $this
     */
    public function addProductToGiftRegistryList()
    {
        $I = $this->user;
        $I->click(self::$addToGiftRegistryLink);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @param string $userName
     * @param string $userPassword
     *
     * @return $this
     */
    public function loginUserForReview($userName, $userPassword)
    {
        $I = $this->user;
        $I->click(self::$reviewLoginLink);
        $userLoginPage = new UserLogin($I);
        $breadCrumb = Translator::translate('LOGIN');
        $userLoginPage->seeOnBreadCrumb($breadCrumb);
        $userLoginPage->login($userName, $userPassword);
        return $this;
    }

    /**
     * @param string $review
     * @param int    $rating
     *
     * @return $this
     */
    public function addReviewAndRating($review, $rating)
    {
        $I = $this->user;
        $I->click(self::$openReviewForm);
       // $I->waitForElement(self::$reviewTextForm);
        $I->fillField(self::$reviewTextForm, $review);
        $I->click(sprintf(self::$ratingSelection, $rating));
        $I->click(self::$saveRatingAndReviewButton);
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
    public function seeUserProductReviewAndRating($reviewId, $userName, $reviewText, $rating)
    {
        $I = $this->user;
        $I->see($userName, sprintf(self::$productReviewAuthor, $reviewId));
        $I->see($reviewText, sprintf(self::$productReviewText, $reviewId));
        $I->seeNumberOfElements(sprintf(self::$userProductRating, $reviewId), $rating);
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
        $I->click(self::$productSuggestionLink);
        $productSuggestionPage = new ProductSuggestion($I);
        $breadCrumb = Translator::translate('RECOMMEND_PRODUCT');
        $productSuggestionPage->seeOnBreadCrumb($breadCrumb);
        $I->see(Translator::translate('RECOMMEND_PRODUCT'), ProductSuggestion::$headerTitle);
        return $productSuggestionPage;
    }

    /**
     * @param string $email
     * @param double $price
     *
     * @return $this
     */
    public function sendPriceAlert($email, $price)
    {
        $I = $this->user;
        $this->openPriceAlert();
        $I->fillField(self::$priceAlertEmail, $email);
        $I->fillField(self::$priceAlertSuggestedPrice, $price);
        $I->click(Translator::translate('SEND'));
        return $this;
    }

    /**
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
     * @return $this
     */
    public function openAttributes()
    {
        $I = $this->user;
        $I->click(Translator::translate('SPECIFICATION'));
        return $this;
    }

    /**
     * @return $this
     */
    public function openDescription()
    {
        $I = $this->user;
        $I->click(Translator::translate('DESCRIPTION'));
        return $this;
    }

    /**
     * @param array $productData
     *
     * @return $this
     */
    public function seeProductData($productData)
    {
        $I = $this->user;
        $I->see($productData['title'], self::$productTitle);
        $I->see($productData['desc'], self::$productShortDesc);
        $I->see($productData['id']);
        $I->see($productData['price'], self::$productPrice);
        return $this;
    }

    public function seeProductOldPrice($price)
    {
        $I = $this->user;
        $I->see($price, self::$productOldPrice);
        return $this;
    }

    public function seeProductUnitPrice($price)
    {
        $I = $this->user;
        $I->see($price, self::$productUnitPrice);
        return $this;
    }

    /**
     * Add current product to basket
     *
     * @param int $amount
     *
     * @return $this
     */
    public function addProductToBasket($amount = 1)
    {
        $I = $this->user;
        $I->fillField(self::$basketAmountField, $amount);
        $I->click(self::$toBasketButton);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @param array $productData
     * @param int   $position
     *
     * @return $this
     */
    public function seeAccessoryData($productData, $position = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf(self::$accessoriesProductTitle, $position));
        $I->see($productData['price'], sprintf(self::$accessoriesProductPrice, $position));
        return $this;
    }

    /**
     * @param int   $position
     *
     * @return $this
     */
    public function openAccessoryDetailsPage($position = 1)
    {
        $I = $this->user;
        $I->click(sprintf(self::$accessoriesProductTitle, $position));
        return $this;
    }

    /**
     * @param array $productData
     * @param int   $position
     *
     * @return $this
     */
    public function seeSimilarProductData($productData, $position = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf(self::$similarProductTitle, $position));
        $I->see($productData['price'], sprintf(self::$similarProductPrice, $position));
        return $this;
    }

    /**
     * @param int   $position
     *
     * @return $this
     */
    public function openSimilarProductDetailsPage($position = 1)
    {
        $I = $this->user;
        $I->click(sprintf(self::$similarProductTitle, $position));
        return $this;
    }

    /**
     * @param array $productData
     * @param int   $position
     *
     * @return $this
     */
    public function seeCrossSellingData($productData, $position = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf(self::$crossSellingProductTitle, $position));
        $I->see($productData['price'], sprintf(self::$crossSellingProductPrice, $position));
        return $this;
    }

    /**
     * @param int   $position
     *
     * @return $this
     */
    public function openCrossSellingDetailsPage($position = 1)
    {
        $I = $this->user;
        $I->click(sprintf(self::$crossSellingProductTitle, $position));
        return $this;
    }

    /**
     * @param array $amountPrices
     *
     * @return $this
     */
    public function seeAmountPrices($amountPrices)
    {
        $I = $this->user;
        $I->click(Translator::translate('BLOCK_PRICE'));
        $I->waitForElementVisible(sprintf(self::$amountPriceQuantity, 1));
        $itemPosition = 1;
        foreach ($amountPrices as $amountPrice) {
            $fromAmount = Translator::translate('FROM').' '.$amountPrice['amountFrom'].' '.Translator::translate('PCS');
            $discountText = $amountPrice['discount'].'% '.Translator::translate('DISCOUNT');
            $I->see($fromAmount, sprintf(self::$amountPriceQuantity, $itemPosition));
            $I->see($discountText, sprintf(self::$amountPriceValue, $itemPosition));
            $itemPosition++;
        }
        $I->click(self::$amountPriceCloseButton);
        return $this;
    }

    /**
     * @return $this
     */
    public function openNextProduct()
    {
        $I = $this->user;
        $I->click(self::$nextProductLink);
        return $this;
    }

    /**
     * @return $this
     */
    public function openPreviousProduct()
    {
        $I = $this->user;
        $I->click(self::$previousProductLink);
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

    public function selectSelectionListItem($selectionItem)
    {
        $I = $this->user;
        $I->click(self::$selectionList);
        $I->click($selectionItem);
        $I->see($selectionItem, self::$selectionList);
        return $this;
    }

    /**
     * @param string $attributeName
     * @param int    $attributeId
     *
     * @return $this
     */
    public function seeAttributeName($attributeName, $attributeId)
    {
        $I = $this->user;
        $I->see($attributeName, sprintf(self::$attributeName, $attributeId));
        return $this;
    }

    /**
     * @param string $attributeValue
     * @param int    $attributeId
     *
     * @return $this
     */
    public function seeAttributeValue($attributeValue, $attributeId)
    {
        $I = $this->user;
        $I->see($attributeValue, sprintf(self::$attributeValue, $attributeId));
        return $this;
    }
}
