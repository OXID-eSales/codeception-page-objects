<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Lists;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * @package OxidEsales\Codeception\Page\Lists
 */
class DistributorList extends Page
{
    public string $headerTitle = 'h1';

    public string $listItemTitle = '#moreSubCat_%s';

    public string $listItemCount = '//div[@class="subcatList"]/div/div[%s]//div[@class="panel-heading"]';

    public string $listItemLink = '//div[@class="subcatList"]/div/div[%s]/div/div[2]';

    /**
     * @param mixed $param
     *
     * @return string
     */
    public function route($param)
    {
        return $this->URL . '/index.php?' . http_build_query(['cl' => 'vendorlist', 'cnid' => 'root']);
    }

    /**
     * Check if item data is displayed correctly.
     * $itemData = ['title', 'count']
     *
     * @param array $itemData
     * @param int   $itemId   The position of the item in the list.
     *
     * @return $this
     */
    public function seeDistributorData(array $itemData, int $itemId = 1): self
    {
        $I = $this->user;
        $I->see($itemData['title'], sprintf($this->listItemTitle, $itemId));
        $I->see($itemData['count'], sprintf($this->listItemCount, $itemId));
        return $this;
    }

    /**
     * @param int $itemId The position of the item in the list.
     *
     * @return ProductList
     */
    public function openDistributorPage(int $itemId): ProductList
    {
        $I = $this->user;
        $productListPage = new ProductList($I);
        $I->click(Translator::translate('DD_LIST_SHOW_MORE'), sprintf($this->listItemLink, $itemId));
        $I->waitForPageLoad();
        return $productListPage;
    }
}
