<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\GiftRegistry\GiftRegistry;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Page\Details\ProductDetails;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class for my-gift-registry page
 * @package OxidEsales\Codeception\Page\Account
 */
class UserGiftRegistry extends Page
{
    use MiniBasket, AccountMenu;

    // include url of current page
    public $URL = '/en/my-gift-registry/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $headerTitle = 'h1';

    public $publicSelection = '#wishlist_blpublic';

    public $saveButton = '';

    public $giftRegistrySearch = '#input_account_wishlist';

    public $searchButton = '';

    public $foundListLink = '//ul[@class="wishlistResults"]/li/a';

    public $recipientName = 'editval[rec_name]';

    public $recipientEmail = 'editval[rec_email]';

    public $emailMessage = 'editval[send_message]';

    public $sendEmailButton = '';

    public $removeFromGitRegistry = '//button[@triggerform="remove_towishlistwishlistProductList_%s"]';

    public $productTitle = '#wishlistProductList_%s';

    public $productDescription = '//div[@id="wishlistProductList"]/div[%s]/div/form[1]/div[2]/div[2]/div[2]';

    public $productPrice = '#productPrice_wishlistProductList_%s';

    public $basketAmount = '#amountToBasket_wishlistProductList_%s';

    public $toBasketButton = '#toBasket_wishlistProductList_%s';

    /**
     * Searches for existing gift registry list.
     *
     * @param string $userName The name of user.
     *
     * @return $this
     */
    public function searchForGiftRegistry(string $userName)
    {
        $I = $this->user;
        $I->fillField($this->giftRegistrySearch, $userName);
        $I->click(Translator::translate('SEARCH'));
        return $this;
    }

    /**
     * Opens gift-registry page of the found list item
     *
     * @return GiftRegistry
     */
    public function openFoundGiftRegistryList()
    {
        $I = $this->user;
        $I->click($this->foundListLink);
        $giftRegistryPage = new GiftRegistry($I);
        $breadCrumb = Translator::translate('PUBLIC_GIFT_REGISTRIES');
        $giftRegistryPage->seeOnBreadCrumb($breadCrumb);
        return $giftRegistryPage;
    }

    /**
     * @param string $email     The email address of the recipient
     * @param string $recipient The name of the recipient
     * @param string $message   The message
     *
     * @return $this
     */
    public function sendGiftRegistryEmail(string $email, string $recipient, string $message)
    {
        $I = $this->user;
        $this->openGiftRegistryEmailForm();
        $I->fillField($this->recipientName, $recipient);
        $I->fillField($this->recipientEmail, $email);
        $I->fillField($this->emailMessage, $message);
        $I->click(Translator::translate('SUBMIT'));
        return $this;
    }

    /**
     * @return $this
     */
    public function openGiftRegistryEmailForm()
    {
        $I = $this->user;
        $I->click(Translator::translate('MESSAGE_SEND_GIFT_REGISTRY'));
        $I->waitForText(Translator::translate('SEND_GIFT_REGISTRY'));
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('MY_GIFT_REGISTRY');
        $this->seeOnBreadCrumb($breadCrumb);
        return $this;
    }

    /**
     * Removes selected product from the list.
     *
     * @param int $itemPosition
     *
     * @return $this
     */
    public function removeFromGiftRegistry(int $itemPosition)
    {
        $I = $this->user;
        $I->click(sprintf($this->removeFromGitRegistry, $itemPosition));
        return $this;
    }

    /**
     * @return $this
     */
    public function makeListSearchable()
    {
        $I = $this->user;
        $I->selectOption($this->publicSelection, 1);
        $I->click(Translator::translate('SAVE'));
        return $this;
    }

    /**
     * @return $this
     */
    public function makeListNotSearchable()
    {
        $I = $this->user;
        $I->selectOption($this->publicSelection, 0);
        $I->click(Translator::translate('SAVE'));
        return $this;
    }

    /**
     * Checks if given product data is shown correctly:
     * ['title', 'description', 'price']
     *
     * @param array $productData
     * @param int   $itemPosition
     *
     * @return $this
     */
    public function seeProductData(array $productData, int $itemPosition = 1)
    {
        $I = $this->user;
        $I->see($productData['title'], sprintf($this->productTitle, $itemPosition));
        $I->see($productData['description'], sprintf($this->productDescription, $itemPosition));
        $I->see($productData['price'], sprintf($this->productPrice, $itemPosition));
        return $this;
    }

    /**
     * Opens the detail page of selected product.
     *
     * @param int $itemPosition
     *
     * @return ProductDetails
     */
    public function openProductDetailsPage(int $itemPosition)
    {
        $I = $this->user;
        $I->click(sprintf($this->productTitle, $itemPosition));
        return new ProductDetails($I);
    }

    /**
     * Adds selected product to the basket.
     *
     * @param int $itemPosition
     * @param int $amount
     *
     * @return $this
     */
    public function addProductToBasket(int $itemPosition, int $amount)
    {
        $I = $this->user;
        $I->fillField(sprintf($this->basketAmount, $itemPosition), $amount);
        $I->click(sprintf($this->toBasketButton, $itemPosition));
        return $this;
    }
}
