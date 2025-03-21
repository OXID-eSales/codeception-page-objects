<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\CoreSetting;

use OxidEsales\Codeception\Page\Page;
use OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester;

use function sprintf;

class SEOTab extends Page
{
    public string $staticSeoUrlSelect = '//select[@name="aStaticUrl[oxseo__oxobjectid]"]';
    public string $standardUrlInput = 'aStaticUrl[oxseo__oxstdurl]';
    public string $localizedUrlInput = 'aStaticUrl[oxseo__oxseourl][%s]';

    public function selectStaticSeoUrl(string $option): self
    {
        $I = $this->user;
        $I->selectOption($this->staticSeoUrlSelect, $option);
        $I->selectEditFrame();
        $I->waitForDocumentReadyState();

        return $this;
    }

    public function seeInStaticSeoUrlFields(string $standardUrl, string $germanUrl, string $englishUrl): self
    {
        $I = $this->user;

        $I->seeInField($this->standardUrlInput, $standardUrl);
        $I->seeInField(sprintf($this->localizedUrlInput, 0), $germanUrl);
        $I->seeInField(sprintf($this->localizedUrlInput, 1), $englishUrl);

        return $this;
    }

    public function fillStaticSeoUrlFields(string $germanUrl, string $englishUrl): self
    {
        $I = $this->user;

        $I->fillField(sprintf($this->localizedUrlInput, 0), $germanUrl);
        $I->fillField(sprintf($this->localizedUrlInput, 1), $englishUrl);

        return $this;
    }


    public function save(): self
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->clickAndWait('save');

        return $this;
    }
}
