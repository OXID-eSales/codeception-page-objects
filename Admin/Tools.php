<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class Tools
 *
 * @package OxidEsales\Codeception\Admin
 */
class Tools extends \OxidEsales\Codeception\Page\Page
{
    public $newLanguageButton = '#btn.new';
    public $activeCheckbox = 'editval[active]';
    public $abbreviationField = 'editval[abbr]';
    public $nameField = 'editval[desc]';

    /**
     * @return Tools
     */
    public function updateDbViews(): Tools
    {
        $I = $this->user;

        $I->selectEditFrame();

        $buttonValue = Translator::translate('TOOLS_MAIN_UPDATEVIEWSNOW');
        $I->click("input[value='" . $buttonValue . "']");
        $I->wait(1);
        $I->acceptPopup();

        return $this;
    }
}
