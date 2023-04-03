<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

class SEOTab extends Page
{
    public $staticSeoUrlSelect = '//select[@name="aStaticUrl[oxseo__oxobjectid]"]';
    public $standardUrlInput = 'aStaticUrl[oxseo__oxstdurl]';
    public $localizedUrlInput = 'aStaticUrl[oxseo__oxseourl][%s]';

    public function selectStaticSeoUrl(string $option): self
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectOption($this->staticSeoUrlSelect, $option);

        return $this;
    }

    public function seeInStaticSeoUrlFields(string $standardUrl, string $germanUrl, string $englishUrl): self
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->seeInField($this->standardUrlInput, $standardUrl);
        $I->seeInField(sprintf($this->localizedUrlInput, 0), $germanUrl);
        $I->seeInField(sprintf($this->localizedUrlInput, 1), $englishUrl);

        return $this;
    }

    public function fillStaticSeoUrlFields(string $germanUrl, string $englishUrl): self
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;

        $I->fillField(sprintf($this->localizedUrlInput, 0), $germanUrl);
        $I->fillField(sprintf($this->localizedUrlInput, 1), $englishUrl);

        return $this;
    }


    public function save(): self
    {
        /** @var AcceptanceTester $I */
        $I = $this->user;
        $I->selectEditFrame();
        $I->click('save');
        $I->waitForPageLoad();

        return $this;
    }
}
