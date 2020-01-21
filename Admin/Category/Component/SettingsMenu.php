<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Category\Component;

use OxidEsales\Codeception\Admin\Category\CategoryRights;
use OxidEsales\Codeception\Module\Translation\Translator;

trait SettingsMenu
{
    public $categoryInformation = '#transfer';

    /**
     * @return CategoryRights
     */
    public function openRights(): CategoryRights
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->waitForElement($this->categoryInformation, 10);
        $I->selectListFrame();
        $I->click(Translator::translate('tbclcategory_rights'));

        return new CategoryRights($I);
    }
}