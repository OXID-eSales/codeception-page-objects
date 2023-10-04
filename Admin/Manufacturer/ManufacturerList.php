<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Manufacturer;

use OxidEsales\Codeception\Admin\Component\FrameLoader;
use OxidEsales\Codeception\Admin\DataObject\Manufacturer;
use OxidEsales\Codeception\Module\Translation\Translator;

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

    public function openPictureTab(string $title): PictureManufacturerPage
    {
        $I = $this->user;

        $this->find($this->titleSearchField, $title);

        $I->selectListFrame();
        $I->click(Translator::translate('tbclmanufacturer_picture'));
        $I->selectEditFrame();

        return new PictureManufacturerPage($I);
    }

    public function openMainTab(string $title): MainManufacturerPage
    {
        $I = $this->user;

        $this->find($this->titleSearchField, $title);

        $I->selectListFrame();
        $I->click(Translator::translate('tbclmanufacturer_main'));
        $I->selectEditFrame();

        return new MainManufacturerPage($I);
    }

    public function createManufacturer(Manufacturer $manufacturer): MainManufacturerPage
    {
        $I = $this->user;
        $mainManufacturerPage = new MainManufacturerPage($I);

        $I->selectEditFrame();
        $this->loadForm($this->newManufacturerButton, $mainManufacturerPage->titleInput);
        $mainManufacturerPage->editManufacturer($manufacturer);
        $pictureManufacturerPage = $this->openPictureTab($manufacturer->getTitle());
        $pictureManufacturerPage->uploadIcon($manufacturer);

        return $this->openMainTab($manufacturer->getTitle());
    }
}
