<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Manufacturer;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class PictureManufacturerPage extends Page
{
    private string $iconInput = "//input[@name='editval[oxmanufacturers__oxicon]']";
    private string $iconFile = "//input[@name='myfile[MICO@oxmanufacturers__oxicon]']";

    public function seeIcon(string $icon): static
    {
        $I = $this->user;
        $I->clickAndWait($this->iconInput);
        $I->retrySeeInField($this->iconInput, $icon);

        return $this;
    }

    public function uploadIcon(string $icon): static
    {
        $I = $this->user;
        $I->attachFile($this->iconFile, $icon);
        $I->clickAndWait(Translator::translate('GENERAL_SAVE'));

        return $this;
    }
}
