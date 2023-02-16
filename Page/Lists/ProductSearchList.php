<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Lists;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Component\Header\SearchWidget;

/**
 * @package OxidEsales\Codeception\Page\Lists
 */
class ProductSearchList extends ProductList
{
    use SearchWidget;

    public string $listItemTitle = '#searchList_%s';

    public string $listItemDescription = '//form[@name="tobasketsearchList_%s"]/div[2]/div[2]/div/div[@class="shortdesc"]';

    public string $listItemPrice = '//form[@name="tobasketsearchList_%s"]/div[2]/div[2]/div/div[@class="price"]/div/span[@class="lead text-nowrap"]';

    public string $listItemForm = '//form[@name="tobasketsearchList_%s"]';

    public string $variantSelection = '#variantselector_searchList_%s button';

    /**
     * @param mixed $param
     *
     * @return string
     */
    public function route($param)
    {
        return $this->URL . '/index.php?' . http_build_query(['cl' => 'search', 'searchparam' => $param]);
    }

    public function seeSearchCount(int $count): self
    {
        $I = $this->user;
        $I->see($count . ' ' . Translator::translate('HITS_FOR'));
        return $this;
    }
}
