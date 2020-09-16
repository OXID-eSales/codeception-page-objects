<?php declare(strict_types=1);
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use Codeception\Util\Locator;
use OxidEsales\Codeception\Admin\Component\AdminUserAddressesForm;
use OxidEsales\Codeception\Admin\Component\AdminUserForm;
use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Admin\Users\ExtendedTab;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;

/**
 * Class Users
 *
 * @package OxidEsales\Codeception\Admin
 */
class Users extends Page
{
    public $searchEmailInput = '//input[@name="where[oxuser][oxusername]"]';
    public $searchForm = '#search';
    public $firstRowName = '//tr[@id="row.1"]//td[2]//div//a';
    public $newRemarkButton = '#btn.newremark';
    public $deleteRemarkButton = "//input[@value='Delete']";
    public $remarktextSelector = "//textarea[@name='remarktext']";
    public $deleteAddressInput = "//input[@value='Delete']";
    public $newAddressButton = '#btn.newaddress';

    /**
     * @param string $field
     * @param string $value
     */
    public function find(string $field, string $value)
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
    }

    /**
     * @param AdminUser $adminUser
     *
     * @return $this
     */
    public function createNewUser(AdminUser $adminUser): void
    {
        $I = $this->user;

        $I->click($this->newButton);

        $I->selectEditFrame();

        $I->waitForElementVisible($this->activeField, 3);
        $I->dontSeeCheckboxIsChecked($this->activeField);

        (new AdminUserForm())->fillForm($I, $adminUser);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();
    }

    /**
     * @param AdminUser $adminUser
     */
    public function editUser(AdminUser $adminUser): void
    {
        $I = $this->user;
        $I->selectEditFrame();

        (new AdminUserForm())->fillForm($I, $adminUser);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();
    }

    public function openExtendedTab(): self
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_extend'));

        $I->selectEditFrame();

        return $this;
    }

    /**
     * @return $this
     */
    public function openHistoryTab(): self
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_remark'));

        $I->selectEditFrame();

        return $this;
    }

    /**
     * @return $this
     */
    public function openProductsTab(): self
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_article'));

        $I->selectEditFrame();

        return $this;
    }

    /**
     * @return $this
     */
    public function openPaymentTab(): self
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_payment'));

        $I->selectEditFrame();

        return $this;
    }

    /**
     * @param string $text
     */
    public function createNewRemark(string $text): void
    {
        $I = $this->user;

        $I->click($this->newRemarkButton);

        $I->selectEditFrame();

        $I->waitForElementVisible($this->remarktextSelector, 3);
        $I->fillField("remarktext", $text);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->selectEditFrame();
    }

    public function deleteRemark(): void
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->click($this->deleteRemarkButton);
        $I->selectEditFrame();
    }

    public function deleteSelectedAddress(): void
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->waitForElementVisible($this->deleteAddressInput, 3);
        $I->click($this->deleteAddressInput);

        $I->selectEditFrame();
    }

    public function openAddressesTab(): self
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->click(Translator::translate('tbcluser_address'));

        $I->selectEditFrame();

        return $this;
    }

    /**
     * @param AdminUserAddresses $adminUserAddresses
     */
    public function createNewAddress(AdminUserAddresses $adminUserAddresses): void
    {
        $I = $this->user;

        $I->click($this->newAddressButton);
        $I->wait(3);
        (new AdminUserAddressesForm())->fillForm($I, $adminUserAddresses);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();
    }
}
