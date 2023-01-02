<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Lists;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Lists\ProductList;
use OxidEsales\Codeception\Page\Component\Header\SearchWidget;

/**
 * Class for product search page
 * @package OxidEsales\Codeception\Page\Lists
 */
class ProductSearchList extends ProductList
{
    use SearchWidget;

    public $listItemTitle = '#searchList_%s';

    public $listItemDescription = '//form[@name="tobasketsearchList_%s"]/div[2]/div[2]/div/div[@class="shortdesc"]';

    public $listItemPrice = '//form[@name="tobasketsearchList_%s"]/div[2]/div[2]/div/div[@class="price"]/div/span[@class="lead text-nowrap"]';

    public $listItemForm = '//form[@name="tobasketsearchList_%s"]';

    public $variantSelection = '#variantselector_searchList_%s button';

    /**
     * @param mixed $param
     *
     * @return string
     */
    public function route($param)
    {
        return $this->URL.'/index.php?'.http_build_query(['cl' => 'search', 'searchparam' => $param]);
    }

    /**
     * @param int $count
     *
     * @return $this
     */
    public function seeSearchCount(int $count)
    {
        $I = $this->user;
        $I->see($count . ' ' . Translator::translate('HITS_FOR'));
        return $this;
    }
}
