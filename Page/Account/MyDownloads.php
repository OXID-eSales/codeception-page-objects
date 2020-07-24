<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account;

use Codeception\Util\Locator;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Component\Header\MiniBasket;
use OxidEsales\Codeception\Page\Component\Modal;
use OxidEsales\Codeception\Page\Component\Pagination;
use OxidEsales\Codeception\Page\Page;

class MyDownloads extends Page
{
    public $URL = '/en/my-downloads/';
    public $breadCrumb = '#breadcrumb';
    public $headerTitle = 'h1';
}
