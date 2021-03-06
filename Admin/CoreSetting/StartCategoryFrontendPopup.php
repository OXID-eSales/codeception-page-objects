<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Page\Page;
use Codeception\Util\Locator;

/**
 * Class StartCategoryFrontendPopup
 *
 * @package OxidEsales\Codeception\Admin\CoreSetting
 */
class StartCategoryFrontendPopup extends Page
{
    public function selectCategory(string $categoryToSelect): StartCategoryFrontendPopup
    {
        $I = $this->user;

        $selectedCat = Locator::find('td', ['id' => '_defcat']);
        $I->dontSeeElement($selectedCat);

        $I->fillField(Locator::find('input', ['name' => '_0']), $categoryToSelect);
        // This should not just wait - but as everything is generated by yahoo javascript
        // this was the only thing to get this working
        $I->wait(2);
        $I->click("//div[@id='container1_c']/table/tbody[2]/tr/td[1]/div/div");
        $I->click('#saveBtn-button');

        // This should not just wait - but as everything is generated by yahoo javascript
        // this was the only thing to get this working
        $I->wait(2);
        $I->seeElement($selectedCat);

        return $this;
    }

    public function unsetCategory(): StartCategoryFrontendPopup
    {
        $I = $this->user;

        $I->seeElement(Locator::find('td', ['id' => '_defcat']));

        $I->click('#remBtn-button');

        $I->waitForElement(Locator::find('button', ['id' => 'remBtn-button', 'disabled' => 'disabled']));

        return $this;
    }
}
