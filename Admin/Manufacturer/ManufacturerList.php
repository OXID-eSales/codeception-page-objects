<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Manufacturer;

use OxidEsales\Codeception\Admin\Component\DataTable;
use OxidEsales\Codeception\Admin\Component\FrameLoader;
use OxidEsales\Codeception\Admin\Component\Tabs;
use OxidEsales\Codeception\Admin\DataObject\Manufacturer;
use OxidEsales\Codeception\Module\Translation\Translator;

trait ManufacturerList
{
    use FrameLoader;
    use DataTable;
    use Tabs;

    private string $newManufacturerButton = '#btn.new';

    public function findByManufacturerTitle(string $title): MainManufacturerPage
    {
        $this->filterRows('oxmanufacturers', 'oxtitle', $title);
        $this->selectFirstRow();

        return new MainManufacturerPage($this->user);
    }

    public function openMainTab(): MainManufacturerPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclmanufacturer_main'));

        return new MainManufacturerPage($I);
    }

    public function openPicturesTab(): PictureManufacturerPage
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbclmanufacturer_picture'));

        return new PictureManufacturerPage($I);
    }

    public function createManufacturer(Manufacturer $manufacturer): MainManufacturerPage
    {
        $mainTab = new MainManufacturerPage($this->user);
        $this->loadForm($this->newManufacturerButton, $mainTab->titleInput);
        $mainTab->editManufacturer($manufacturer);

        return $mainTab;
    }
}
