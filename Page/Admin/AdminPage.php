<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Admin;

use OxidEsales\Codeception\Page\Page;

/**
 * Class AdminPage
 *
 * @package OxidEsales\Codeception\Page\Admin
 */
class AdminPage extends Page
{

    public $listIframe = 'list';
    public $editIframe = 'edit';
    public $headerIframe = 'header';
    public $baseFormName = 'basefrm';
    public $adminnavIframe = 'adminnav';
    public $newShopButtonId = '#btn.new';
    public $navigationIframe = 'navigation';
    public $productClassName = '.productClass';
    public $subShopLink = '/html/body/div[1]/div/div/div[2]/div/a[2]';
    public $mainShopLink = '/html/body/div[1]/div/div/div[2]/div/a[1]';
    public $coreSettingsLink = '/html/body/table/tbody/tr/td[1]/dl[1]/dd/ul/li[1]/a';
}
