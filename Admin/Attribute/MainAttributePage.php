<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Attribute;

use OxidEsales\Codeception\Admin\Attribute\Popup\AssignProductsPopup;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

class MainAttributePage extends Page
{
    use AttributeList;

    private string $assignProductsButton = "//input[@value='%s']";
    private string $saveButton = "//input[@name='save']";
    private string $titleField = "//input[@name='editval[oxattribute__oxtitle]']";

    public function openAssignProductsPopup(): AssignProductsPopup
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click(sprintf($this->assignProductsButton, Translator::translate('GENERAL_ASSIGNARTICLES')));
        $I->switchToNextTab();
        $I->waitForAjax();

        return new AssignProductsPopup($I);
    }

    public function save(): self
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click($this->saveButton);
        $I->waitForDocumentReadyState();
        return $this;
    }

    public function createAttribute(string $name): self
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->fillField($this->titleField, $name);
        $this->save();
        return $this;
    }
}
