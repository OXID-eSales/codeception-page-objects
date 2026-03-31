<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Language;

use OxidEsales\Codeception\Admin\Component\FrameLoader;

trait LanguageList
{
    use FrameLoader;

    private string $newLanguageButton = '#btn.new';

    public function openLanguageByName(string $name): MainLanguagePage
    {
        $I = $this->user;
        $mainPage = new MainLanguagePage($I);

        $I->retrySelectListFrame();
        $I->retryClick($name);
        $I->selectEditFrame();
        $I->waitForElementClickable($mainPage->saveButton);

        return $mainPage;
    }

    public function createNewLanguage(string $abbreviation, string $name): self
    {
        $I = $this->user;
        $mainPage = new MainLanguagePage($I);

        $I->selectEditFrame();
        $this->loadForm($this->newLanguageButton, $mainPage->nameField);

        $I->checkOption($mainPage->activeCheckbox);
        $I->fillField($mainPage->abbreviationField, $abbreviation);
        $I->fillField($mainPage->nameField, $name);
        $mainPage->save();

        $I->retrySelectListFrame();
        $I->waitForDocumentReadyState();
        $I->retrySee($name);

        return $this;
    }
}
