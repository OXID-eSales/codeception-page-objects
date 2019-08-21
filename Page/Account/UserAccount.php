<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

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
    public $breadCrumb = '#breadcrumb';

    public $dashboardChangePasswordPanelHeader = '#linkAccountPassword';

    public $dashboardCompareListPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[3]/div[1]';

    public $dashboardCompareListPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[3]/div[2]';

    public $dashboardWishListPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[1]/div[1]';

    public $dashboardWishListPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[1]/div[2]';

    public $dashboardGiftRegistryPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[2]/div[1]';

    public $dashboardGiftRegistryPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[2]/div[2]';

    public $dashboardListmaniaPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[4]/div[1]';

    public $dashboardListmaniaPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[4]/div[2]';

    public $dashboardOrderHistoryHeader = '#linkAccountOrder';

    /**
     * @return UserLogin
     */
    public function logoutUserInAccountPage()
    {
        $I = $this->user;
        $this->openAccountMenu();
        $I->click(Translator::translate('LOGOUT'));
        $userLoginPage = new UserLogin($I);
        $breadCrumb = Translator::translate('LOGIN');
        $userLoginPage->seeOnBreadCrumb($breadCrumb);

        return $userLoginPage;
    }

    /**
     * Opens my-password page
     *
     * @return UserChangePassword
     */
    public function openChangePasswordPage()
    {
        $I = $this->user;
        $I->click($this->dashboardChangePasswordPanelHeader);
        $userChangePasswordPage = new UserChangePassword($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT') . Translator::translate('CHANGE_PASSWORD');
        $userChangePasswordPage->seeOnBreadCrumb($breadCrumb);

        return $userChangePasswordPage;
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
}
