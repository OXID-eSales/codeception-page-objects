<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Service;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class GenericExport extends Page
{
    public string $selectCategoryInput = 'select[name="acat[]"]';
    public string $startExportButton =  "//input[@type='submit'][contains(@value, '%s')]";
    public string $exportResultsFile = 'div.export a';

    public function selectExportCategory(string $category): self
    {
        $I = $this->user;
        $I->selectGenericExportMainFrame();
        $I->selectOption($this->selectCategoryInput, $category);
        return $this;
    }

    public function doExport(): self
    {
        $I = $this->user;
        $I->selectGenericExportMainFrame();
        $I->click(sprintf($this->startExportButton, Translator::translate('Start Export')));
        $I->selectGenericExportStatusFrame();
        $I->waitForText(Translator::translate('AUCTMASTER_DO_EXPORTEND'));
        return $this;
    }

    public function seeInExportResultsFile(string $text): self
    {
        $I = $this->user;
        $I->selectGenericExportStatusFrame();
        $url = $I->grabAttributeFrom($this->exportResultsFile, 'href');
        $I->amOnUrl($url);
        $I->see($text);
        return $this;
    }
}
