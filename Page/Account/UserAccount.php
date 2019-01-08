<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Page\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

class UserAccount extends Page
{
    use AccountMenu, AccountNavigation;

    // include url of current page
    public static $URL = '/en/my-account/';

    // include bread crumb of current page
    public static $breadCrumb = '#breadcrumb';

    public static $dashboardChangePasswordPanelHeader = '#linkAccountPassword';

    public static $dashboardCompareListPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[3]/div[1]';

    public static $dashboardCompareListPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[3]/div[2]';

    public static $dashboardWishListPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[1]/div[1]';

    public static $dashboardWishListPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[1]/div[2]';

    public static $dashboardGiftRegistryPanelHeader = '//div[@class="accountDashboardView"]/div/div[2]/div[2]/div[1]';

    public static $dashboardGiftRegistryPanelContent = '//div[@class="accountDashboardView"]/div/div[2]/div[2]/div[2]';

    /**
     * @return UserLogin
     */
    public function logoutUser()
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
        $I->click(self::$dashboardChangePasswordPanelHeader);
        $userChangePasswordPage = new UserChangePassword($I);
        $breadCrumb = Translator::translate('MY_ACCOUNT').Translator::translate('CHANGE_PASSWORD');
        $userChangePasswordPage->seeOnBreadCrumb($breadCrumb);
        return $userChangePasswordPage;
    }
}
