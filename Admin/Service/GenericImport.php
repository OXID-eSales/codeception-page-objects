<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Service;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class GenericImport extends Page
{
    public string $attachCsvFileInput = 'input[name=csvfile]';
    public string $targetTableSelector = 'select[name=sType]';
    public string $csvEnclosureInput = 'input[name="sGiCsvFieldEncloser"]';
    public string $csvTerminatorInput = 'input[name="sGiCsvFieldTerminator"]';
    public string $useFirstLineAsCsvHeaderInput = 'input[name=blContainsHeader]';
    public string $proceedToNextStepButton =  "//input[@type='submit'][contains(@value, '%s')]";
    public string $csvColumnToFieldMappingSelector = 'table.genImportFieldsAssign > tbody > tr:nth-child(%d) select';

    public function setTargetTable(string $tableName): self
    {
        $I = $this->user;
        $I->selectOption($this->targetTableSelector, $tableName);
        return $this;
    }

    public function setCsvSourceFile(string $csvFilePath): self
    {
        $I = $this->user;
        $I->attachFile($this->attachCsvFileInput, $csvFilePath);
        return $this;
    }

    public function setCsvFieldTerminator(string $fieldTerminator): self
    {
        $I = $this->user;
        $I->fillField(
            $this->csvTerminatorInput,
            $fieldTerminator
        );
        return $this;
    }

    public function setCsvFieldEnclosure(string $enclosure): self
    {
        $I = $this->user;
        $I->fillField(
            $this->csvEnclosureInput,
            $enclosure
        );
        return $this;
    }

    public function setFirstCsvRowContainsHeaders(): self
    {
        $I = $this->user;
        $I->checkOption($this->useFirstLineAsCsvHeaderInput);
        return $this;
    }

    public function proceedToFieldMapping(string $tableName): self
    {
        $I = $this->user;
        $I->click(sprintf($this->proceedToNextStepButton, Translator::translate('Upload file')));
        $I->waitForText(Translator::translate('GENIMPORT_ASSIGNFIELDS'));
        $I->see($tableName);
        return $this;
    }

    public function setCsvColumnToFieldMapping(int $csvColumn, string $dbField): self
    {
        $I = $this->user;
        $I->selectOption(
            sprintf($this->csvColumnToFieldMappingSelector, $csvColumn),
            $dbField
        );
        return $this;
    }

    public function seeCsvColumnToFieldMapping(int $csvColumn, string $dbField): self
    {
        $I = $this->user;
        $I->seeOptionIsSelected(
            sprintf($this->csvColumnToFieldMappingSelector, $csvColumn),
            $dbField
        );
        return $this;
    }

    public function doImport(): self
    {
        $I = $this->user;
        $I->click(sprintf($this->proceedToNextStepButton, Translator::translate('Begin import')));
        $I->waitForText(Translator::translate('GENIMPORT_IMPORTDONE'));
        return $this;
    }
}
