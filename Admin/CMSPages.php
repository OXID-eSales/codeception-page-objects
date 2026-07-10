<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Component\EditForm;
use OxidEsales\Codeception\Page\Page;

class CMSPages extends Page
{
    use EditForm;

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
        $this->openForm($this->newCMSButton);

        //create new CMS
        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->title, $title);
        $I->fillField($this->ident, $ident);
        $I->fillField($this->content, $content);
        $this->submitForm($this->saveButton);
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
