<?php declare(strict_types=1);
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use Codeception\Module\WebDriver;
use Codeception\Util\Locator;
use OxidEsales\Codeception\Admin\Component\AdminUserAddressesForm;
use OxidEsales\Codeception\Admin\Component\AdminUserExtendedInfoForm;
use OxidEsales\Codeception\Admin\Component\AdminUserForm;
use OxidEsales\Codeception\Admin\Component\FillForm;
use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Admin\DataObject\AdminUserExtendedInfo;
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
    use AdminUserForm;
    use AdminUserAddressesForm;
    use AdminUserExtendedInfoForm;

    public $searchEmailInput = '//input[@name="where[oxuser][oxusername]"]';
    public $searchForm = '#search';
    public $firstRowName = '//tr[@id="row.1"]//td[2]//div//a';
    public $newRemarkButton = '#btn.newremark';
    public $deleteRemarkButton = "//input[@value='Delete']";
    public $remarktextSelector = "//textarea[@name='remarktext']";
    public $deleteAddressInput = "//input[@value='Delete']";
    public $extendedTabUserAddress = "#test_userAddress";
    public $historyTabRemarkSelect = "//select[@name='rem_oxid']";
    public $addressesTabAddressSelect = 'oxaddressid';
    public $searchResultFirtRowUsernameColumn = "//tr[@id='row.1']/td[3]";
    public $searchResultSecondRowUsernameColumn = "//tr[@id='row.2']/td[3]";
    public $remarkField = 'remarktext';
    public $usernameSearchField = "where[oxuser][oxusername]";
    public $extendedInfoTabUserAddress = "#test_userAddress";

    /**
     * @param string $field
     * @param string $value
     */
    public function find(string $field, string $value): self
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

        return $this;
    }

    /**
     * @param AdminUser $adminUser
     *
     * @return $this
     */
    public function createNewUser(AdminUser $adminUser): self
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->newUserButton);

        $I->waitForPageLoad();
        $I->dontSeeCheckboxIsChecked($this->userActiveField);

        $this->fillUserMainForm($I, $adminUser);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();

        return $this;
    }

    /**
     * @param AdminUser $adminUser
     */
    public function editUser(AdminUser $adminUser): self
    {
        $I = $this->user;
        $I->selectEditFrame();

        $this->fillUserMainForm($I, $adminUser);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();

        return $this;
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
    public function createNewRemark(string $text): self
    {
        $I = $this->user;

        $I->click($this->newRemarkButton);

        $I->selectEditFrame();

        $I->waitForPageLoad();
        $I->fillField("remarktext", $text);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->selectEditFrame();

        return $this;
    }

    public function deleteRemark(): self
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->click($this->deleteRemarkButton);
        $I->selectEditFrame();

        return $this;
    }

    public function deleteSelectedAddress(): self
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->deleteAddressInput);

        $I->selectEditFrame();

        return $this;
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
    public function createNewAddress(AdminUserAddresses $adminUserAddresses): self
    {
        $I = $this->user;

        $I->click($this->newAddressButton);

        $I->waitForPageLoad();
        $this->fillUserAddressForm($I, $adminUserAddresses);

        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();

        return $this;
    }

    /**
     * @param AdminUserExtendedInfo $adminUserExtendedInfo
     */
    public function editExtentedInfo(AdminUserExtendedInfo $adminUserExtendedInfo): self
    {
        $I = $this->user;
        $I->selectEditFrame();

        $this->fillUserExtendedInfoForm($I, $adminUserExtendedInfo);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();

        return $this;
    }
}
