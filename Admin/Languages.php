<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class Languages
 *
 * @package OxidEsales\Codeception\Admin
 */
class Languages extends \OxidEsales\Codeception\Page\Page
{
    public $newLanguageButton = '#btn.new';
    public $activeCheckbox = 'editval[active]';
    public $abbreviationField = 'editval[abbr]';
    public $nameField = 'editval[desc]';

    /**
     * @param string $abbreviation
     * @param string $name
     *
     * @return Languages
     */
    public function createNewLanguage(string $abbreviation, string $name): Languages
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->click($this->newLanguageButton);
        $I->wait(3);

        //create new Language
        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->abbreviationField, $abbreviation);
        $I->fillField($this->nameField, $name);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->wait(5);

        $I->selectListFrame();
        $I->waitForText($name, 10);

        return $this;
    }
}
