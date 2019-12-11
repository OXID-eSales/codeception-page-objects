<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\CoreSetting\Component;

/**
 * Trait header
 */
trait ListHeader
{
    public $numberInput = "//input[@name='where[oxshops][oxname]']";
    public $searchForm = '#search';

    /**
     * @param string $field
     * @param string $value
     *
     * @return $this
     */
    public function find(string $field, string $value): self
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame(); // Waits for list section to load

        $I->click($value);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        return $this;
    }
}
