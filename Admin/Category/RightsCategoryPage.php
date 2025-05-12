<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Category;

use OxidEsales\Codeception\Admin\Component\AssignPopup;
use OxidEsales\Codeception\Admin\Component\EditForm;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

use function sprintf;

class RightsCategoryPage extends Page
{
    use AssignPopup;
    use CategoryList;
    use EditForm;

    private string $assignVisibleRightsButton = "//input[@value='%s']";
    private string $inheritRightsCheckbox = "//input[@name='editval[oxcategories__oxrootid]'][@type='checkbox']";
    private string $saveButton = "//input[@name='save']";

    public function enableInheritRights(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->checkOption($this->inheritRightsCheckbox);
        $this->submitForm($this->saveButton);

        return $this;
    }

    public function disableInheritRights(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->uncheckOption($this->inheritRightsCheckbox);
        $this->submitForm($this->saveButton);

        return $this;
    }

    public function assignUserRightsToCategory(): static
    {
        $I = $this->user;
        $this->openAssignPopup(
            sprintf($this->assignVisibleRightsButton, Translator::translate('CATEGORY_RIGHTS_ASSIGNVISIBLE'))
        );
        $I->clickAndWait(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->closeTab();

        return $this;
    }
}
