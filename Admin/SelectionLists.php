<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Page\Page;

class SelectionLists extends Page
{
    private string $fieldSelect = '#aFields';
    private string $fieldOptionByName = '//select[@id="aFields"]/option[contains(text(), "%s")]';
    private string $saveFieldButton = '#submit_modify';
    private string $deleteSelectedFieldsButton = '#submit_delete';
    private string $addFieldNameInput = '#EditAddName';
    private string $addFieldPriceInput = '#EditAddPrice';
    private string $addFieldPriceUnitSelect = '#EditAddPriceUnit';
    private string $addFieldPositionInput = '#EditAddPos';
    private string $addFieldButton = "//input[@type='submit' and contains(@onclick, 'addfield')]";
    private string $selectionListTitleInput = 'input[name="editval[oxselectlist__oxtitle]"]';
    private string $selectionListTitleInputWithValue =
        '//input[@name="editval[oxselectlist__oxtitle]" and @value="%s"]';
    private string $selectionListIdentInput = 'input[name="editval[oxselectlist__oxident]"]';
    private string $saveSelectionListButton = "//input[@type='submit' and contains(@onclick, \"value='save'\")]";
    private string $assignProductsButton = "//input[@type='button' and contains(@onclick, 'aoc=1')]";

    public function selectSelectionList(string $title): static
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->seeText($title);
        $I->clickAndWait($title);

        $I->selectEditFrame();
        $I->waitForElement(sprintf($this->selectionListTitleInputWithValue, $title));

        return $this;
    }

    public function seeAddFieldFormEnabled(): static
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->seeElement($this->addFieldNameInput . ':not([disabled])');
        $I->seeElement($this->addFieldPriceInput . ':not([disabled])');
        $I->seeElement($this->addFieldPriceUnitSelect . ':not([disabled])');
        $I->seeElement($this->addFieldPositionInput . ':not([disabled])');
        $I->seeElement($this->addFieldButton . '[not(@disabled)]');

        return $this;
    }

    public function seeAddFieldFormDisabled(): static
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->seeElement($this->addFieldNameInput . '[disabled]');
        $I->seeElement($this->addFieldPriceInput . '[disabled]');
        $I->seeElement($this->addFieldPriceUnitSelect . '[disabled]');
        $I->seeElement($this->addFieldPositionInput . '[disabled]');
        $I->seeElement($this->addFieldButton . '[@disabled]');

        return $this;
    }

    public function seeEditFormReadOnly(): static
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->seeElement($this->selectionListTitleInput . '[disabled]');
        $I->seeElement($this->selectionListIdentInput . '[disabled]');
        $I->seeElement($this->fieldSelect . '[disabled]');
        $I->seeElement($this->saveSelectionListButton . '[@disabled]');
        $I->seeElement($this->assignProductsButton . '[@disabled]');

        $this->seeAddFieldFormDisabled();
        $this->seeFieldActionsDisabled();

        return $this;
    }

    public function seeFieldActionsEnabled(): static
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->seeElement($this->saveFieldButton . ':not([disabled])');
        $I->seeElement($this->deleteSelectedFieldsButton . ':not([disabled])');

        return $this;
    }

    public function seeFieldActionsDisabled(): static
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->seeElement($this->saveFieldButton . '[disabled]');
        $I->seeElement($this->deleteSelectedFieldsButton . '[disabled]');

        return $this;
    }

    public function selectField(string $fieldName): static
    {
        $I = $this->user;

        $I->selectEditFrame();
        $fieldOption = sprintf($this->fieldOptionByName, $fieldName);
        $I->waitForElement($fieldOption);
        $field = $I->grabTextFrom($fieldOption);
        $I->selectOption($this->fieldSelect, $field);
        $I->waitForElement($this->saveFieldButton . ':not([disabled])');

        return $this;
    }
}
