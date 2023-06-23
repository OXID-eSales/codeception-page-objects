<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use OxidEsales\Codeception\ShopSetup\DataObject\UserInput;

class DatabaseStep extends SetupStep
{
    private string $fillAllFieldsErrorMessage = 'ERROR: Please fill in all needed fields!';
    private string $accessDeniedErrorMessage = 'Access denied for user';
    private string $createDbButton = '#step3Submit';
    private string $overwriteDbButton = '#step3Continue';
    private string $showPasswordButton = '#sDbPassCheckbox';
    private string $dbHostInput = '//input[@name="aDB[dbHost]"]';
    private string $dbPortInput = '//input[@name="aDB[dbPort]"]';
    private string $dbUserNameInput = '//input[@name="aDB[dbUser]"]';
    private string $dbNameInput = '//input[@name="aDB[dbName]"]';
    private string $dbUserPasswordInput = '#sDbPassPlain';
    private string $useDemodataInput = '//input[@name="aDB[dbiDemoData]"]';
    private string $disabledUseDemoDataInput = '//input[@name="aDB[dbiDemoData]" and @disabled=""]';

    public function getWaitForStepLoadElement(): string
    {
        return $this->createDbButton;
    }

    public function proceedToDirectoryAndLoginStep(): DirectoryAndLoginStep
    {
        $I = $this->user;
        $I->click($this->createDbButton);

        return new DirectoryAndLoginStep($this->user);
    }

    public function proceedToDirectoryAndLoginStepIfDbExists(): DirectoryAndLoginStep
    {
        $I = $this->user;
        $I->click($this->createDbButton);
        $I->waitForElementClickable($this->overwriteDbButton);
        $I->click($this->overwriteDbButton);

        return new DirectoryAndLoginStep($this->user);
    }

    public function returnToDatabaseStepIfAccessDenied(): static
    {
        $I = $this->user;
        $I->click($this->createDbButton);
        $I->waitForText($this->accessDeniedErrorMessage);

        return $this;
    }

    public function returnToDatabaseStepIfRequiredFieldsNotSet(): static
    {
        $I = $this->user;
        $I->click($this->createDbButton);
        $I->waitForText($this->fillAllFieldsErrorMessage);

        return $this;
    }

    public function fillDatabaseConnectionFields(UserInput $userInput): static
    {
        $I = $this->user;
        $I->checkOption($this->showPasswordButton);

        $I->fillField($this->dbNameInput, $userInput->getDbName());
        $I->fillField($this->dbHostInput, $userInput->getDbHost());
        $I->fillField($this->dbPortInput, $userInput->getDbPort());
        $I->fillField($this->dbUserNameInput, $userInput->getDbUserName());
        $I->fillField($this->dbUserPasswordInput, $userInput->getDbUserPassword());

        return $this;
    }

    public function selectSetupWithoutDemodata(): static
    {
        $I = $this->user;
        $I->selectOption($this->useDemodataInput, '0');

        return $this;
    }

    public function selectSetupWithDemodata(): static
    {
        $I = $this->user;
        $I->selectOption($this->useDemodataInput, '1');

        return $this;
    }

    public function seeDemodataIsNotAvailable(): static
    {
        $I = $this->user;
        $I->seeOptionIsSelected($this->useDemodataInput, '0');
        $I->seeElement($this->disabledUseDemoDataInput);

        return $this;
    }
}
