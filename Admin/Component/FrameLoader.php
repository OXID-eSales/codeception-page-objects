<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

trait FrameLoader
{
    /**
     * @param string $loadTrigger
     * @param string $editableTextInput
     * @return void
     */
    public function loadForm(string $loadTrigger, string $editableTextInput): void
    {
        $I = $this->user;

        $I->amGoingTo('enter some arbitrary data into text input of the current form');
        $randomValue = uniqid('random-', true);
        $I->waitForElement($editableTextInput);
        $I->fillField($editableTextInput, $randomValue);
        $I->retrySeeInField($editableTextInput, $randomValue);

        $I->click($loadTrigger);

        $I->expect('to see the request finished and initial form was replaced by a new one');
        $I->waitForDocumentReadyState();
        $I->waitForElement($editableTextInput);
        $I->retryDontSeeInField($editableTextInput, $randomValue);
    }
}
