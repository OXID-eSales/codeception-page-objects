<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Footer;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Lists\ProductList;
use OxidEsales\Codeception\Page\Lists\ManufacturerList;

/**
 * Trait for service menu widget in footer
 * @package OxidEsales\Codeception\Page\Component\Footer
 */
trait ManufacturerWidget
{
    public string $manufacturerLink = '//ul[@class="manufacturers list-unstyled"]';
    
    public string $manufacturersWrapper = '.footer-box-manufacturers';

    public function openManufacturerPage(string $manufacturerTitle): ProductList
    {
        $I = $this->user;
        $productListPage = new ProductList($I);
        $I->click($manufacturerTitle, $this->manufacturerLink);
        $I->waitForPageLoad();
        return $productListPage;
    }

    public function openManufacturerListPage(): ManufacturerList
    {
        $I = $this->user;
        $listPage = new ManufacturerList($I);
        $I->click(Translator::translate('ALL_BRANDS'), $this->manufacturerLink);
        $I->waitForPageLoad();
        $I->see(Translator::translate('BY_MANUFACTURER'), $listPage->headerTitle);
        return $listPage;
    }
}
