<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Category;

use OxidEsales\Codeception\Admin\Category\Component\Footer;
use OxidEsales\Codeception\Admin\Category\Component\SettingsMenu;
use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class CategoryRights
 */
class CategoryRights extends \OxidEsales\Codeception\Page\Page
{
    use Footer, SettingsMenu;

    /**
     * @return $this
     */
    public function assignUserRightsToSelectedCategory(): self
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('CATEGORY_RIGHTS_ASSIGNVISIBLE'));

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }
}
