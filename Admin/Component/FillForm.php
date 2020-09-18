<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use Codeception\Actor;

class FillForm
{
    /**
     * @param Actor  $I
     * @param string $element
     * @param string $value
     */
    public function fillFormInput(Actor $I, string $element, string $value): void
    {
        $I->fillField($element, $value);
    }

    /**
     * @param Actor  $I
     * @param string $element
     * @param bool   $status
     */
    public function chooseFormCheckbox(Actor $I, string $element, bool $status): void
    {
        ($status) ? $I->checkOption($element) : $I->uncheckOption($element);
    }

    /**
     * @param Actor  $I
     * @param string $element
     * @param string $value
     */
    public function chooseFormSelect(Actor $I, string $element, string $value): void
    {
        $I->selectOption($element, $value);
    }

}
