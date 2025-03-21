<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use Facebook\WebDriver\WebDriverElement;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class CMSPages extends Page
{
    public string $newCMSButton = '#btn.new';
    public string $activeCheckbox = 'editval[oxcontents__oxactive]';
    public string $title = 'editval[oxcontents__oxtitle]';
    public string $ident = 'editval[oxcontents__oxloadid]';
    public string $content = 'oxcontents__oxcontent';
    public string $searchForm = '#search';
    private string $saveButton = '//input[@name="saveContent"]';

    public function createNewCMS(string $title, string $ident, string $content): CMSPages
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->waitForElementClickable($this->newCMSButton);
        $I->clickAndWait($this->newCMSButton);
        $I->waitForElementClickable($this->newCMSButton);

        //create new CMS
        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->title, $title);
        $I->fillField($this->ident, $ident);
        $I->fillField($this->content, $content);
        $I->clickAndWait($this->saveButton);
        $I->waitForDocumentReadyState();
        $I->selectEditFrame();
        $I->selectListFrame();

        return $this;
    }

    public function find(string $field, string $value): void
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->waitForDocumentReadyState();
        $I->submitForm($this->searchForm, []);
        $I->waitForDocumentReadyState();
        $I->selectListFrame();

        $I->waitForText($value);
        $I->clickAndWait($value);
        $I->selectListFrame();
        $I->selectEditFrame();
    }
}
