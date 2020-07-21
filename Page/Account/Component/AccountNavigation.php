<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account\Component;

use Codeception\Util\Locator;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Account\MyDownloads;
use OxidEsales\Codeception\Page\Account\MyReviews;
use OxidEsales\Codeception\Page\Account\NewsletterSettings;
use OxidEsales\Codeception\Page\Account\UserAddress;
use OxidEsales\Codeception\Page\Account\UserGiftRegistry;
use OxidEsales\Codeception\Page\Account\UserListmania;
use OxidEsales\Codeception\Page\Account\UserWishList;
use OxidEsales\Codeception\Page\Page;

trait AccountNavigation
{
    /** @var string  */
    public $accountMenu = 'nav#account_menu';

    /** @deprecated since v1.3.1 (2020-04-09); Property will be removed. */
    public $newsletterSettingsLink = '//nav[@id="account_menu"]';
    /** @deprecated since v1.3.1 (2020-04-09); Property will be removed. */
    public $addressSettingsLink = '//nav[@id="account_menu"]';
    /** @deprecated since v1.3.1 (2020-04-09); Property will be removed. */
    public $giftRegistryLink = '//nav[@id="account_menu"]';
    /** @deprecated since v1.3.1 (2020-04-09); Property will be removed. */
    public $wishListLink = '//nav[@id="account_menu"]';
    /** @deprecated since v1.3.1 (2020-04-09); Property will be removed. */
    public $listmaniaLink = '//nav[@id="account_menu"]';

    /** @return NewsletterSettings */
    public function openNewsletterSettingsPage(): NewsletterSettings
    {
        $this->clickLinkOnAccountMenu('NEWSLETTER_SETTINGS');
        $page = new NewsletterSettings($this->user);
        $this->seePageBreadcrumbs($page, 'NEWSLETTER_SETTINGS');
        $this->seePageTitle($page, 'PAGE_TITLE_ACCOUNT_NEWSLETTER');
        return $page;
    }

    /** @return UserAddress */
    public function openUserAddressPage(): UserAddress
    {
        $this->clickLinkOnAccountMenu('BILLING_SHIPPING_SETTINGS');
        $page = new UserAddress($this->user);
        $this->seePageBreadcrumbs($page, 'BILLING_SHIPPING_SETTINGS');
        $this->seePageTitle($page, 'BILLING_SHIPPING_SETTINGS');
        return $page;
    }

    /** @return UserGiftRegistry */
    public function openGiftRegistryPage(): UserGiftRegistry
    {
        $this->clickLinkOnAccountMenu('MY_GIFT_REGISTRY');
        $page = new UserGiftRegistry($this->user);
        $this->seePageBreadcrumbs($page, 'MY_GIFT_REGISTRY');
        $this->seePageTitle($page, 'PAGE_TITLE_ACCOUNT_WISHLIST');
        return $page;
    }

    public function dontSeeGiftRegistryLink(): void
    {
        $this->dontSeeLinkInAccountMenu('MY_GIFT_REGISTRY');
    }

    /** @return UserWishList */
    public function openWishListPage(): UserWishList
    {
        $this->clickLinkOnAccountMenu('MY_WISH_LIST');
        $page = new UserWishList($this->user);
        $this->seePageBreadcrumbs($page, 'MY_WISH_LIST');
        $this->seePageTitle($page, 'PAGE_TITLE_ACCOUNT_NOTICELIST');
        return $page;
    }

    /** @return UserListmania */
    public function openListmaniaPage(): UserListmania
    {
        $this->clickLinkOnAccountMenu('MY_LISTMANIA');
        $page = new UserListmania($this->user);
        $this->seePageBreadcrumbs($page, 'PAGE_TITLE_ACCOUNT_RECOMMLIST');
        $this->seePageTitle($page, 'PAGE_TITLE_ACCOUNT_RECOMMLIST');
        return $page;
    }

    /** @return MyReviews */
    public function openMyReviewsPage(): MyReviews
    {
        $this->clickLinkOnAccountMenu('MY_REVIEWS');
        $page = new MyReviews($this->user);
        $this->seePageBreadcrumbs($page, 'MY_REVIEWS');
        $this->seePageTitle($page, 'MY_REVIEWS');
        return $page;
    }

    public function dontSeeMyReviewsLink(): void
    {
        $this->dontSeeLinkInAccountMenu('MY_REVIEWS');
    }

    public function dontSeeMyReviewsPageTitle(): void
    {
        $page = new MyReviews($this->user);
        $this->dontSeePageTitle($page, 'MY_REVIEWS');
    }

    /** @param int $cnt */
    public function seeNumberOnMyReviewsBadge(int $cnt): void
    {
        $I = $this->user;
        $I->see(
            (string) $cnt,
            sprintf(
                '%s%s',
                Locator::contains("$this->accountMenu li a", Translator::translate('MY_REVIEWS')),
                Locator::find('span', ['class' => 'badge'])
            )
        );
    }

    public function openMyDownloadsPage(): void
    {
        $this->clickLinkOnAccountMenu('MY_DOWNLOADS');
        $page = new MyDownloads($this->user);
        $this->seePageBreadcrumbs($page, 'MY_DOWNLOADS');
        $this->seePageTitle($page, 'PAGE_TITLE_ACCOUNT_DOWNLOADS');
    }

    /** @param string $title */
    private function clickLinkOnAccountMenu(string $title): void
    {
        $I = $this->user;
        $I->waitForElement($this->accountMenu);
        $I->click(Translator::translate($title), $this->accountMenu);
        $I->waitForPageLoad();
    }

    /** @param string $title */
    private function dontSeeLinkInAccountMenu(string $title): void
    {
        $I = $this->user;
        $I->waitForElement($this->accountMenu);
        $I->dontSee(Translator::translate($title), $this->accountMenu);
    }

    /**
     * @param Page $page
     * @param string $breadcrumb
     */
    private function seePageBreadcrumbs(Page $page, string $breadcrumb): void
    {
        $page->seeOnBreadCrumb(
            Translator::translate('MY_ACCOUNT') . Translator::translate($breadcrumb)
        );
    }

    /**
     * @param Page $page
     * @param string $title
     */
    private function seePageTitle(Page $page, string $title): void
    {
        $this->user->see(Translator::translate($title), $page->headerTitle);
    }

    /**
     * @param Page $page
     * @param string $title
     */
    private function dontSeePageTitle(Page $page, string $title): void
    {
        $this->user->dontSee(Translator::translate($title), $page->headerTitle);
    }
}
