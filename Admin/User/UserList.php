<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class Users
 *
 * @package OxidEsales\Codeception\Admin\User
 */
trait UserList
{
    public $searchEmailInput = '//input[@name="where[oxuser][oxusername]"]';
    public $searchForm = '#search';
    public $firstRowName = '//tr[@id="row.1"]//td[2]//div//a';
    public $usernameSearchField = "where[oxuser][oxusername]";
    public $newUserButton  = '#btn.new';
    public $newRemarkButton = '#btn.newremark';
    public $newAddressButton = '#btn.newaddress';

    /**
     * @param string $field
     * @param string $value
     * @return MainUserPage
     */
    public function find(string $field, string $value): MainUserPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame(); // Waits for list section to load

        $I->click($this->firstRowName);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new MainUserPage($I);
    }

    /**
     * @param string $value
     * @return MainUserPage
     */
    public function findByUserName(string $value): MainUserPage
    {
        return $this->find($this->usernameSearchField, $value);
    }

    /**
     * @param AdminUser $adminUser
     *
     * @return MainUserPage
     */
    public function createNewUser(AdminUser $adminUser, AdminUserAddresses $adminUserAddress): MainUserPage
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->newUserButton);

        $I->waitForPageLoad();
        $mainUserPage = new MainUserPage($I);
        $I->dontSeeCheckboxIsChecked($mainUserPage->userActiveField);
        $mainUserPage->fillUserMainForm($I, $adminUser, $adminUserAddress);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();

        return $mainUserPage;
    }

    /**
     * @return ExtendedInformationPage
     */
    public function openExtendedTab(): ExtendedInformationPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_extend'));

        $I->selectEditFrame();

        return new ExtendedInformationPage($I);
    }

    /**
     * @return UserHistoryPage
     */
    public function openHistoryTab(): UserHistoryPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_remark'));

        $I->selectEditFrame();

        return new UserHistoryPage($I);
    }

    /**
     * @return UserProductsPage
     */
    public function openProductsTab(): UserProductsPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_article'));

        $I->selectEditFrame();

        return new UserProductsPage($I);
    }

    /**
     * @return UserPaymentInformationPage
     */
    public function openPaymentTab(): UserPaymentInformationPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_payment'));

        $I->selectEditFrame();

        return new UserPaymentInformationPage($I);
    }

    /**
     * @return UserAddressPage
     */
    public function openAddressesTab(): UserAddressPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_address'));

        $I->selectEditFrame();

        return new UserAddressPage($I);
    }

    /**
     * @param string $text
     * @return UserHistoryPage
     */
    public function createNewRemark(string $text): UserHistoryPage
    {
        $I = $this->user;

        $I->click($this->newRemarkButton);

        $I->selectEditFrame();

        $I->waitForPageLoad();

        $historyPage = new UserHistoryPage($I);
        $I->fillField($historyPage->remarkField, $text);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->selectEditFrame();

        return $historyPage;
    }

    /**
     * @param AdminUserAddresses $adminUserAddresses
     * @return UserAddressPage
     */
    public function createNewAddress(AdminUserAddresses $adminUserAddresses): UserAddressPage
    {
        $I = $this->user;

        $I->click($this->newAddressButton);

        $I->waitForPageLoad();
        $addressPage = new UserAddressPage($I);
        $addressPage->fillUserAddressForm($I, $adminUserAddresses);

        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();

        return $addressPage;
    }
}
