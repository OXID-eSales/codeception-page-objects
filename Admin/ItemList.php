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

    protected $createNewItemButton = '//div[@class="actions"]//a[@id="btn.new"]';

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
     * @param ItemListTab $tabPage
     *
     * @return ItemListTab
     */
    public function openItemTab(ItemListTab $tabPage): ItemListTab
    {
        $I = $this->user;

        $I->selectListFrame();
        $selector = sprintf($this->tabSelector, $tabPage::TAB_KEY);
        $I->waitForElement($selector, 10);

        $I->executeJS("document.evaluate(\"$selector\", document, null, XPathResult.FIRST_ORDERED_NODE_TYPE, null).singleNodeValue.click()");

        $I->selectEditFrame();
        $I->waitForElement($this->navigationInformation, 10);

        return $tabPage;
    }

    /**
     * @param ItemListTab $tabPage
     *
     * @return ItemListTab
     */
    protected function openCreateNewItem(ItemListTab $tabPage): ItemListTab
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->createNewItemButton);
        $I->waitForPageLoad();
        $I->waitForElement($this->navigationInformation, 10);

        return $tabPage;
    }
}
