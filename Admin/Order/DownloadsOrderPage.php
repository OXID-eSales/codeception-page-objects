<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Order;

use OxidEsales\Codeception\Page\Page;

/**
 * class DownloadsOrderPage
 *
 * @package OxidEsales\Codeception\Admin\Order
 */
class DownloadsOrderPage extends Page
{
    use OrderList;

    public $productNumberInDownloadsTab = "//tr[@id='file.1']/td[1]";
    public $titleInDownloadsTab = "//tr[@id='file.1']/td[2]";
    public $downloadableFileInDownloadsTab = "//tr[@id='file.1']/td[3]";
    public $firstDownloadInDownloadsTab = "//tr[@id='file.1']/td[4]";
    public $lastDownloadInDownloadsTab = "//tr[@id='file.1']/td[5]";
    public $countInDownloadsTab = "//tr[@id='file.1']/td[6]";
    public $maxCountInDownloadsTab = "//tr[@id='file.1']/td[7]";
}
