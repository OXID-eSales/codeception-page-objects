<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Admin\Component\Tabs;
use OxidEsales\Codeception\Admin\Theme\ThemeSettingsTab;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class Themes extends Page
{
    use Tabs;

    public function selectTheme(string $themeTitle): static
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->seeText($themeTitle);
        $I->clickAndWait($themeTitle);
        $I->selectEditFrame();
        $I->waitForPageLoad();

        return $this;
    }

    public function openSettingsTab(): ThemeSettingsTab
    {
        $I = $this->user;
        $this->openTab(Translator::translate('tbcltheme_config'));

        return new ThemeSettingsTab($I);
    }
}
