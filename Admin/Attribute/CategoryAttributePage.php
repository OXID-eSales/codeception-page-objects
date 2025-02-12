<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Attribute;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Admin\Attribute\Popup\AssignCategoriesPopup;
use OxidEsales\Codeception\Module\Translation\Translator;

class CategoryAttributePage extends Page
{
    use AttributeList;

    private string $assignCategoriesButton = "//input[@value='%s']";

    public function openAssignCategoriesPopup(): AssignCategoriesPopup
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(sprintf($this->assignCategoriesButton, Translator::translate('GENERAL_ASSIGNCATEGORIES')));
        $I->switchToNextTab();
        $I->waitForAjax();

        return new AssignCategoriesPopup($I);
    }
}
