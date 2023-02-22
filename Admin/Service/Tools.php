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
        $I->click($this->updateDbViewsButton);
        $I->retryAcceptPopup();
        $I->waitForDocumentReadyState();

        return $this;
    }

    public function runSqlUpdate(string $sqlCommand): self
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->fillField($this->sqlTextInput, $sqlCommand);
        $I->click($this->runUpdateSqlButton);
        $I->waitForDocumentReadyState();

        return $this;
    }

    public function seeInSqlOutput(string $text): self
    {
        $I = $this->user;
        $I->selectListFrame();
        $I->see($text, $this->sqlOutputElement);

        return $this;
   }
}
