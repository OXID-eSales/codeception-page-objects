<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category;

use OxidEsales\Codeception\Admin\Category\Popup\AssignProductsPopup;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

class RightsCategoryPage extends Page
{
    use CategoryList;

    private string $assignVisibleRightsButton = "//input[@value='%s']";
    private string $inheritRightsCheckbox = "//input[@name='editval[oxcategories__oxrootid]'][@type='checkbox']";
    private string $saveButton = "//input[@name='save']";

    public function enableInheritRights(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->checkOption($this->inheritRightsCheckbox);
        $I->click($this->saveButton);
        $I->waitForPageLoad();
        return $this;
    }

    public function disableInheritRights(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->uncheckOption($this->inheritRightsCheckbox);
        $I->click($this->saveButton);
        $I->waitForPageLoad();
        return $this;
    }

    public function assignUserRightsToCategory(): static
    {
        $I = $this->user;
        $I->selectEditFrame();

        $assignButtonSelector = sprintf($this->assignVisibleRightsButton, Translator::translate('CATEGORY_RIGHTS_ASSIGNVISIBLE'));
        $I->click($assignButtonSelector);

        $I->switchToNextTab();
        $I->waitForDocumentReadyState();
        $I->click(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->waitForElement('#container2 .yui-dt-data tr');
        $I->closeTab();

        return $this;
    }
}
