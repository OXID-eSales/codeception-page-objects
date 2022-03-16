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
    public $sqlTextInput = '#myedit textarea[name="updatesql"]';
    public $uploadSqlFileInput = '#myedit input[name="myfile[SQL1@usqlfile]"]';
    public $runUpdateSqlButton = '#myedit input[name="save"]';
    public $updateDbViewsButton = '#regerateviews input.confinput';

    public function updateDbViews(): Tools
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->click($this->updateDbViewsButton);
        $I->retryAcceptPopup();
        $I->waitForDocumentReadyState();

        return $this;
    }
}
