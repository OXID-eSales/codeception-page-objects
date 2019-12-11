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
 * Class Main
 */
class Main extends \OxidEsales\Codeception\Page\Page
{
    use Footer, SettingsMenu;

    public $newCategoryName = 'editval[oxcategories__oxtitle]';
    public $activeCategoryCheckbox = 'editval[oxcategories__oxactive]';

    /**
     * @param string $categoryName
     *
     * @return $this
     */
    public function createNewCategory(string $categoryName): self
    {
        $I = $this->user;

        $I->checkOption($this->activeCategoryCheckbox);
        $I->fillField($this->newCategoryName, $categoryName);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->selectListFrame();
        $I->waitForText($categoryName);

        return $this;
    }

    /**
     * @return $this
     */
    public function assignProducts(): self
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(Translator::translate('GENERAL_ASSIGNARTICLES'));

        $I->switchToNextTab();//codeception way of opening next window
        $I->waitForDocumentReadyState();
        $I->click(Translator::translate('GENERAL_AJAX_ASSIGNALL'));
        $I->waitForAjax(10);
        $I->closeTab();

        return $this;
    }
}
