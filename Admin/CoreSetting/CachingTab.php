<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Admin\CoreSetting\Section\ContentCache;
use OxidEsales\Codeception\Admin\CoreSetting\Section\DataCache;
use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

class CachingTab extends Page
{
    private string $dataCacheBlock = '//form[@id=\'myedit1\']//div[@class="groupExp"][1]/div/a';
    private string $contentCacheBlock = '//form[@id=\'myedit1\']//div[@class="groupExp"][2]/div/a';

    public function openDataCache(): DataCache
    {
        $I = $this->user;

        $I->click($this->dataCacheBlock);

        return new DataCache($I);
    }

    public function openContentCache(): ContentCache
    {
        $I = $this->user;

        $I->click($this->contentCacheBlock);

        return new ContentCache($I);
    }
}
