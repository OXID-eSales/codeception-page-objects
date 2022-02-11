<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Component\FrameLoader;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class Languages extends Page
{
    use FrameLoader;

    public $newLanguageButton = '#btn.new';
    public $activeCheckbox = "//input[@name='editval[active]'][@type='checkbox']";
    public $abbreviationField = "//input[@name='editval[abbr]']";
    public $nameField = "//input[@name='editval[desc]']";

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
        $this->loadForm($this->newLanguageButton, $this->nameField);

        $I->amGoingTo('fill and submit the form');
        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->abbreviationField, $abbreviation);
        $I->fillField($this->nameField, $name);
        $I->click(Translator::translate('GENERAL_SAVE'));

        $I->expect('to see the new language in the list');
        $I->retrySelectListFrame();
        $I->waitForText($name);

        return $this;
    }
}
