<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Page\Page;

/**
 * Class Users
 *
 * @package OxidEsales\Codeception\Admin\User
 */
class UserRemarkPage extends Page
{
    use UserList;

    public $deleteRemark = "//input[@value='Delete']";
    public $remarktextSelector = "//textarea[@name='remarktext']";
    public $remarkField = 'remarktext';

    public function deleteRemark(): self
    {
        $I = $this->user;

        $I->selectEditFrame();

        $I->click($this->deleteRemark);
        $I->selectEditFrame();

        return $this;
    }
}
