<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Page\Page;

class UserHistoryPage extends Page
{
    use UserList;

    public string $historyTabRemarkSelect = "//select[@name='rem_oxid']";
    public string $deleteRemark = "//input[@value='Delete']";
    public string $remarkTextSelector = "//textarea[@name='remarktext']";
    public string $remarkField = 'remarktext';

    public function deleteRemark(): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->clickAndWait($this->deleteRemark);
        $I->waitForElementVisible($this->deleteRemark);

        return $this;
    }

    public function selectUserRemark($listItem): static
    {
        $I = $this->user;
        $I->selectEditFrame();
        $I->selectOption($this->historyTabRemarkSelect, $listItem);
        $I->waitForDocumentReadyState();

        return $this;
    }
}
