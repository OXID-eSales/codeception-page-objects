<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class CMSPages
 *
 * @package OxidEsales\Codeception\Admin
 */
class CMSPages extends \OxidEsales\Codeception\Page\Page
{
    public $newCMSButton = '#btn.new';
    public $activeCheckbox = 'editval[oxcontents__oxactive]';
    public $title = 'editval[oxcontents__oxtitle]';
    public $ident = 'editval[oxcontents__oxloadid]';
    public $content = 'oxcontents__oxcontent';
    public $searchForm = '#search';

    /**
     * @param string $title
     * @param string $ident
     * @param string $content
     *
     * @return CMSPages
     */
    public function createNewCMS(string $title, string $ident, string $content): CMSPages
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->click($this->newCMSButton);
        $I->wait(3);

        //create new CMS
        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->title, $title);
        $I->fillField($this->ident, $ident);
        $I->fillField($this->content, $content);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->wait(3);

        $I->selectListFrame();

        return $this;
    }

    /**
     * @param string $field
     * @param string $value
     */
    public function find(string $field, string $value): void
    {
        $I = $this->user;

        $I->selectListFrame();
        $I->fillField($field, $value);
        $I->submitForm($this->searchForm, []);
        $I->selectListFrame();

        $I->click($value);
        $I->selectListFrame();
    }
}
