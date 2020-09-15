<?php declare(strict_types=1);
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use Codeception\Util\Locator;
use OxidEsales\Codeception\Admin\Component\AdminUserForm;
use OxidEsales\Codeception\Admin\DataObject\AdminUser;
use OxidEsales\Codeception\Admin\Users\ExtendedTab;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class Users
 *
 * @package OxidEsales\Codeception\Admin
 */
class Users extends Page
{

    use AdminUserForm;

    public $searchEmailInput = '//input[@name="where[oxuser][oxusername]"]';
    public $searchForm = '#search';
    public $firstRowName = '//tr[@id="row.1"]//td[2]//div//a';
    public $newRemarkButton = '#btn.newremark';
    public $deleteRemarkButton = "//input[@value='Delete']";
    public $remarktextSelector = "//textarea[@name='remarktext']";

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

        $I->selectEditFrame();
        $I->click($this->newButton);

        $I->waitForElementVisible($this->activeFieldSelector, 3);
        $I->dontSeeCheckboxIsChecked($this->activeField);

        $this->fillAdminUserForm($I, $adminUser);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();
    }

    /**
     * @param AdminUser $adminUser
     */
    public function editUser(AdminUser $adminUser): void
    {
        $I = $this->user;

        $this->fillAdminUserForm($I, $adminUser);
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

        $I->selectEditFrame();

        $I->click($this->newRemarkButton);

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
}
