<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Manufacturer;

use OxidEsales\Codeception\Admin\DataObject\Manufacturer;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Module\Translation\Translator;

class PictureManufacturerPage extends Page
{
    use ManufacturerList;

    public string $iconInput = "//input[@name='editval[oxmanufacturers__oxicon]']";
    private string $iconFile = "//input[@name='myfile[MICO@oxmanufacturers__oxicon]']";

    public function seeManufacturerIcon(Manufacturer $manufacturer): self
    {
        $I = $this->user;

        $I->seeInField($this->iconInput, $manufacturer->getIcon());

        return $this;
    }

    public function uploadIcon(Manufacturer $manufacturer): self
    {
        $I = $this->user;

        $I->attachFile($this->iconFile, $manufacturer->getIcon());
        $I->click(Translator::translate('GENERAL_SAVE'));

        return $this;
    }
}
