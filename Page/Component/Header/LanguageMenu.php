<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Component\Header;

/**
 * Trait for language menu widget.
 * @package OxidEsales\Codeception\Page\Component\Header
 */
trait LanguageMenu
{
    public $languageMenuButton = "//div[@class='btn-group languages-menu']/button";

    public $openLanguageMenu = "//div[@class='btn-group languages-menu open']";

    /**
     * @param string $language
     *
     * @return $this
     */
    public function switchLanguage(string $language)
    {
        $I = $this->user;
        $I->click($this->languageMenuButton);
        $I->waitForElement($this->openLanguageMenu);
        $I->click($language);
        $I->waitForElement($this->languageMenuButton);
        return $this;
    }
}
