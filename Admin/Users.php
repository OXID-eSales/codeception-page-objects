<?php declare(strict_types=1);
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Page\Page;

/**
 * Class Users
 *
 * @package OxidEsales\Codeception\Admin
 */
class Users extends Page
{
    public $searchEmailInput = '//input[@name="where[oxuser][oxusername]"]';
    public $searchForm = '#search';

    /**
     * @param string $field
     * @param string $value
     */
    public function find(string $field, string $value)
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
    }
}
