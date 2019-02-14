<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Header;

trait LanguageMenu
{
    public static $languageMenuButton = "//div[@class='btn-group languages-menu']/button";

    public static $openLanguageMenu = "//div[@class='btn-group languages-menu open']";

    /**
     * @param string $language
     *
     * @return $this
     */
    public function switchLanguage($language)
    {
        $I = $this->user;
        $I->click(self::$languageMenuButton);
        $I->waitForElement(self::$openLanguageMenu);
        $I->click($language);
        $I->waitForElement(self::$languageMenuButton);
        return $this;
    }
}
