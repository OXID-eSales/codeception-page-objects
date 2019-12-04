<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

/**
 * Class ItemList
 *
 * General admin list with items.
 *
 * @package OxidEsales\Codeception\Admin
 */
class ItemList extends \OxidEsales\Codeception\Page\Page
{
    public $navigationInformation = '#transfer';
    public $tabSelector = "//div[@class='tabs']//a[@href='#%s']";

    /**
     * Select the item with a specific title from the list
     * and wait till edit frame with navigation information will be updated.
     *
     * @param string $itemName
     *
     * @return self
     */
    public function selectItem(string $itemName): self
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->waitForText($itemName, 10);
        $I->click($itemName);
        $I->selectEditFrame();
        $I->waitForElement($this->navigationInformation, 10);

        return $this;
    }

    /**
     * @param string $tabName
     *
     * @return ItemListTab
     */
    public function openItemTab(ListItemTab $page): ItemListTab
    {
        $I = $this->user;

        $I->selectListFrame();
        $selector = sprintf($this->tabSelector, $page::TAB_KEY);
        $I->waitForElement($selector, 10);

        $I->click($selector);
        $I->selectEditFrame();
        $I->waitForElement($this->navigationInformation, 10);

        return $page;
    }
}
