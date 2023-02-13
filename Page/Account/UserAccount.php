<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Module\Context;
use OxidEsales\Codeception\Page\Account\Component\AccountNavigation;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class for my-account page
 *
 * @package OxidEsales\Codeception\Page\Account
 */
class UserAccount extends Page
{

    use AccountMenu, AccountNavigation;

    // include url of current page
    public $URL = '/en/my-account/';

    // include bread crumb of current page
    public $breadCrumb = '.breadcrumb';
    
    public $headerTitle = '';

    public $dashboardChangePasswordPanelHeader = '#linkAccountPassword';

    public $dashboardCompareListPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[3]/div[1]';

    public $dashboardCompareListPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[3]/div[2]';

    public $dashboardWishListPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[1]/div[1]';

    public $dashboardWishListPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[1]/div[2]';

    public $dashboardGiftRegistryPanelHeader = '//h4';

    public $dashboardGiftRegistryPanelContent = '//h4[contains(text(),"%s")]/following-sibling::div';

    public $dashboardListmaniaPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[4]/div[1]';

    public $dashboardListmaniaPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[4]/div[2]';

    public $dashboardOrderHistoryHeader = '#linkAccountOrder';

    public $openReviewPageOnDashboard = '//div[contains(text(),"%s")]/following-sibling::a';

    public function seePageOpened()
    {
        $I = $this->user;
        $I->see(Translator::translate('LOGOUT'));
        return $this;
    }
    
    /**
     * @return UserLogin
     */
    public function logoutUserInAccountPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(Translator::translate('LOGOUT'));
        $userLoginPage = new UserLogin($I);
        $I->see(Translator::translate('LOGIN'));

        return $userLoginPage;
    }

    public function loginUserInAccountPage()
    {
        $I = $this->user;
        // logging in
        $this->openAccountMenu();
        $I->waitForElementVisible($this->userLoginName);
        $I->fillField($this->userLoginName, $userName);
        $I->fillField($this->userLoginPassword, $userPassword);
        $I->click($this->userLoginButton);
        $I->waitForPageLoad();
        Context::setActiveUser($userName);
        return $this;
    }

    /**
     * Opens my-password page
     *
     * @return UserChangePassword
     */
    public function openChangePasswordPage()
    {
        return $this->openChangePasswordPageInAccountMenu();
    }

    /**
     * Opens order-hisotry page.
     *
     * @return UserOrderHistory
     */
    public function openOrderHistory()
    {
        $I = $this->user;
        $I->click($this->dashboardOrderHistoryHeader);
        $userOrderHistoryPage = new UserOrderHistory($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT') . Translator::translate('ORDER_HISTORY');
        $userOrderHistoryPage->seeOnBreadCrumb($breadCrumb);

        return $userOrderHistoryPage;
    }

    public function seeItemNumberOnGiftRegistryPanel(string $number)
    {
        $I = $this->user;
        $I->see(Translator::translate('MY_GIFT_REGISTRY'), $this->dashboardGiftRegistryPanelHeader);
        $I->see(
            Translator::translate('PRODUCT') . ' ' . $number,
            sprintf($this->dashboardGiftRegistryPanelContent, Translator::translate('MY_GIFT_REGISTRY'))
        );
        return $this;
    }

    public function seeItemNumberOnReviewPanel(int $number)
    {
        $I = $this->user;
        $I->see(Translator::translate('MY_REVIEWS') . ' ' . $number);
        return $this;
    }

    /**
     * Opens order-hisotry page.
     *
     * @return MyReviews
     */
    public function openMyReviewsPage()
    {
        $I = $this->user;
        $I->retryClick(sprintf($this->openReviewPageOnDashboard, Translator::translate('MY_REVIEWS')));
        $page = new MyReviews($this->user);
        $this->seePageTitle($page, 'MY_REVIEWS');
        return $page;
    }

}
