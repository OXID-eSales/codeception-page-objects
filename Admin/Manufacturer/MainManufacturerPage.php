<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Manufacturer;

use OxidEsales\Codeception\Admin\DataObject\Manufacturer;
use OxidEsales\Codeception\Page\Page;

class MainManufacturerPage extends Page
{
    use ManufacturerList;

    public string $activeInput = "//input[@name='editval[oxmanufacturers__oxactive]']";
    public string $titleInput = "//input[@name='editval[oxmanufacturers__oxtitle]']";
    public string $shortDescriptionInput = "//input[@name='editval[oxmanufacturers__oxshortdesc]']";
    public string $sortValueInput = "//input[@name='editval[oxmanufacturers__oxsort]']";
    public string $saveButton = "//input[@name='saveArticle']";

    public function editManufacturer(Manufacturer $manufacturer): self
    {
        $I = $this->user;
        if ($manufacturer->isActive()) {
            $I->checkOption($this->activeInput);
        } else {
            $I->uncheckOption($this->activeInput);
        }
        $I->fillField($this->titleInput, $manufacturer->getTitle());
        $I->fillField($this->shortDescriptionInput, $manufacturer->getShortDescription());
        $I->fillField($this->sortValueInput, $manufacturer->getSortValue());
        $I->clickAndWait($this->saveButton);
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();
        $I->waitForElementClickable($this->saveButton);

        return $this;
    }

    public function seeManufacturer(Manufacturer $manufacturer): self
    {
        $I = $this->user;

        $I->seeInField($this->activeInput, $manufacturer->isActive());
        $I->seeInField($this->titleInput, $manufacturer->getTitle());
        $I->seeInField($this->shortDescriptionInput, $manufacturer->getShortDescription());
        $I->seeInField($this->sortValueInput, (string)$manufacturer->getSortValue());

        return $this;
    }
}
