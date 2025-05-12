<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Admin\Component\EditForm;
use OxidEsales\Codeception\Page\Page;

class ExtendedInformationPage extends Page
{
    use EditForm;

    private string $isProductConfigurableOption = "editval[oxarticles__oxisconfigurable]";
    private string $saveProductButton = "//input[@name='save']";

    public function enableProductCustomization(): static
    {
        $I = $this->user;
        $I->checkOption($this->isProductConfigurableOption);
        $this->submitForm($this->saveProductButton);

        return $this;
    }
}
