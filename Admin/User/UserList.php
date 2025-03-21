<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\Component\FrameLoader;
use OxidEsales\Codeception\Admin\Component\Tabs;
use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;
use OxidEsales\Codeception\Module\Translation\Translator;

trait UserList
{
    use FrameLoader;
    use Tabs;

    public string $searchEmailInput = '//input[@name="where[oxuser][oxusername]"]';
    public string $searchForm = '#search';
    public string $firstRowName = '//tr[@id="row.1"]//td[2]//div//a';
    public string $usernameSearchField = "where[oxuser][oxusername]";
    public string $newUserButton  = '#btn.new';
    public string $newRemarkButton = '#btn.newremark';
    public string $newAddressButton = '#btn.newaddress';

    public function find(string $field, string $value): MainUserPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame(); // Waits for list section to load

        $I->clickAndWait($this->firstRowName);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return new MainUserPage($I);
    }

    public function findByUserName(string $value): MainUserPage
    {
        return $this->find($this->usernameSearchField, $value);
    }

    public function createNewUser(AdminUser $adminUser, AdminUserAddresses $adminUserAddress): MainUserPage
    {
        $I = $this->user;
        $mainUserPage = new MainUserPage($I);

        $I->selectEditFrame();
        $this->loadForm($this->newUserButton, $mainUserPage->userFirstNameField);
        $mainUserPage->editUser($adminUser, $adminUserAddress);

        return $mainUserPage;
    }

    public function openExtendedTab(): ExtendedInformationPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbcluser_extend'));

        return new ExtendedInformationPage($I);
    }

    public function openHistoryTab(): UserHistoryPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbcluser_remark'));

        return new UserHistoryPage($I);
    }

    public function openProductsTab(): UserProductsPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbcluser_article'));

        return new UserProductsPage($I);
    }

    public function openPaymentTab(): UserPaymentInformationPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbcluser_payment'));

        return new UserPaymentInformationPage($I);
    }

    public function openAddressesTab(): UserAddressPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbcluser_address'));

        return new UserAddressPage($I);
    }

    public function createNewRemark(string $text): UserHistoryPage
    {
        $I = $this->user;
        $I->clickAndWait($this->newRemarkButton);
        $I->selectEditFrame();
        $historyPage = new UserHistoryPage($I);
        $I->fillField($historyPage->remarkField, $text);
        $I->clickAndWait(Translator::translate('GENERAL_SAVE'));

        $I->selectEditFrame();

        return $historyPage;
    }

    public function createNewAddress(AdminUserAddresses $adminUserAddresses): UserAddressPage
    {
        $I = $this->user;
        $addressPage = new UserAddressPage($I);

        $I->selectEditFrame();
        $this->loadForm($this->newAddressButton, $addressPage->addressFirstNameField);
        $addressPage->editUserAddress($adminUserAddresses);

        return $addressPage;
    }
}
