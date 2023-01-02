<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page;

use OxidEsales\Codeception\Page\Component\Footer\Footer;
use OxidEsales\Codeception\Page\Component\Header\Header;

/**
 * Class for home page
 * @package OxidEsales\Codeception\Page
 */
class Home extends Page
{
    use Header, Footer;

    // include url of current page
    public $URL = '/';
}
