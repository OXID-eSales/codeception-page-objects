<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Page\Page;

/**
 * Class for thank you page
 * @package OxidEsales\Codeception\Page\Checkout
 */
class ThankYou extends Page
{
    // include url of current page
    public $URL = '/index.php?cl=thankyou&lang=1';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';
}
