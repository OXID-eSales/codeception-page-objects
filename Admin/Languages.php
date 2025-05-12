<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Component\EditForm;
use OxidEsales\Codeception\Admin\Component\FrameLoader;
use OxidEsales\Codeception\Page\Page;

class Languages extends Page
{
    use EditForm;
    use FrameLoader;

    public string $newLanguageButton = '#btn.new';
    public string $activeCheckbox = "//input[@name='editval[active]'][@type='checkbox']";
    public string $abbreviationField = "//input[@name='editval[abbr]']";
    public string $nameField = "//input[@name='editval[desc]']";

    public function createNewLanguage(string $abbreviation, string $name): Languages
    {
        $I = $this->user;

        $I->selectEditFrame();
        $this->loadForm($this->newLanguageButton, $this->nameField);

        $I->amGoingTo('fill and submit the form');
        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->abbreviationField, $abbreviation);
        $I->fillField($this->nameField, $name);
        $this->submitForm();

        $I->expect('to see the new language in the list');
        $I->retrySelectListFrame();
        $I->comment('creating multiple languages can be slow on some systems');
        $I->amGoingTo('wait till the process ends, with increased timeout');
        $I->seeText(text: $name, timeout: 30);

        return $this;
    }
}
