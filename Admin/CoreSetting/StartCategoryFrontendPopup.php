<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class StartCategoryFrontendPopup extends Page
{
    public string $defaultCategoryLabelContainer = 'td#_defcat';
    public string $categoryNameSearchFilter = "//input[@name='_0']";
    public string $categoryDescriptionSearchFilter = "//input[@name='_1']";
    public string $datTableFirstRow = "div#container1_c > table > tbody.yui-dt-data > tr:first-child";
    public string $dateTableSelectedRow = '.yui-dt-selected';

    public function selectCategory(string $categoryName): StartCategoryFrontendPopup
    {
        $I = $this->user;

        $I->fillField($this->categoryNameSearchFilter, $categoryName);
        $I->waitForElementNotVisible($this->datTableFirstRow . $this->dateTableSelectedRow);
        $I->waitForText($categoryName, 10, $this->datTableFirstRow);
        $I->click($this->datTableFirstRow);
        $I->waitForElementVisible($this->datTableFirstRow . $this->dateTableSelectedRow);
        $I->click(Translator::translate('SHOP_CONFIG_ASSIGNDEFAULTCAT'));
        $I->waitForDocumentReadyState();
        $I->waitForText($this->getDefaultCategoryLabel($categoryName), 10, $this->defaultCategoryLabelContainer);

        return $this;
    }

    public function unsetCategory(): StartCategoryFrontendPopup
    {
        $I = $this->user;

        $I->waitForElementVisible($this->defaultCategoryLabelContainer);
        $I->click(Translator::translate('SHOP_CONFIG_UNASSIGNDEFAULTCAT'));
        $I->waitForDocumentReadyState();
        $I->waitForElementNotVisible($this->defaultCategoryLabelContainer);

        return $this;
    }

    private function getDefaultCategoryLabel(string $categoryName): string
    {
        return sprintf("%s: %s", Translator::translate('SHOP_CONFIG_ASSIGNEDDEFAULTCAT'), $categoryName);
    }
}
