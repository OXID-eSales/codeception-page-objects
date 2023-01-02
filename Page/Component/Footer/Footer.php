<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Component\Footer;

use OxidEsales\Codeception\Page\Component\Footer\NewsletterBox;
use OxidEsales\Codeception\Page\Component\Footer\ServiceWidget;
use OxidEsales\Codeception\Page\Component\Footer\ManufacturerWidget;
use OxidEsales\Codeception\Page\Component\Footer\CategoryWidget;
use OxidEsales\Codeception\Page\Component\Footer\InformationWidget;

/**
 * Trait for service menu widget in footer
 * @package OxidEsales\Codeception\Page\Component\Footer
 */
trait Footer
{
    use NewsletterBox, ServiceWidget, ManufacturerWidget, CategoryWidget, InformationWidget;
}
