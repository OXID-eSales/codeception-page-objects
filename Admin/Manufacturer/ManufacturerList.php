<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Manufacturer;

use OxidEsales\Codeception\Admin\DataObject\Manufacturer;
use OxidEsales\Codeception\Admin\Component\FrameLoader;

trait ManufacturerList
{
    use FrameLoader;

    public string $searchForm = '#search';
    public string $titleSearchField = "where[oxmanufacturers][oxtitle]";
    public string $newManufacturerButton = "#btn.new";
    public string $firstRowName = '//tr[@id="row.1"]//td[2]//div//a';

    public function find(string $searchField, string $value): MainManufacturerPage
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($searchField, $value);
        $I->submitForm($this->searchForm, []);

        $I->selectListFrame();
        $I->click($this->firstRowName);
        $I->selectEditFrame();

        return new MainManufacturerPage($I);
    }

    public function findByManufacturerTitle(string $title): MainManufacturerPage
    {
        return $this->find($this->titleSearchField, $title);
    }

    public function createManufacturer(Manufacturer $manufacturer): MainManufacturerPage
    {
        $I = $this->user;
        $mainManufacturerPage = new MainManufacturerPage($I);

        $I->selectEditFrame();
        $this->loadForm($this->newManufacturerButton, $mainManufacturerPage->titleInput);
        $mainManufacturerPage->editManufacturer($manufacturer);

        return $mainManufacturerPage;
    }
}
