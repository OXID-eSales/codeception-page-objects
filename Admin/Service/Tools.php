<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Service;

use OxidEsales\Codeception\Page\Page;

class Tools extends Page
{
    public string $sqlTextInput = '#myedit textarea[name="updatesql"]';
    public string $uploadSqlFileInput = '#myedit input[name="myfile[SQL1@usqlfile]"]';
    public string $runUpdateSqlButton = '#myedit input[name="save"]';
    public string $updateDbViewsButton = '#regerateviews input.confinput';
    public string $sqlOutputElement = '.editnavigation';

    public function updateDbViews(): Tools
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->waitForElement($this->updateDbViewsButton);
        $I->openAlert($this->updateDbViewsButton);
        $I->retryAcceptPopup();
        $I->waitForDocumentReadyState();

        return $this;
    }

    public function runSqlUpdate(string $sqlCommand): self
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->waitForElement($this->sqlTextInput);
        $I->fillField($this->sqlTextInput, $sqlCommand);
        $I->clickAndWait($this->runUpdateSqlButton);
        $I->waitForDocumentReadyState();

        return $this;
    }

    public function seeInSqlOutput(string $text): self
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->seeText($text, $this->sqlOutputElement);

        return $this;
    }
}
