<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use OxidEsales\Codeception\Page\Page;

class DatabaseStep extends Page
{
    private string $fillAllFieldsErrorMessage = 'ERROR: Please fill in all needed fields!';
    private string $cannotOpenSqlErrorMessage = 'ERROR: Cannot open SQL file';
    private string $sqlInsertingErrorMessage = 'ERROR: Issue while inserting this SQL statements:';
    private string $sqlSyntaxErrorMessage = 'SQLSTATE[42000]: Syntax error or access violation: 1064 You have an error in your SQL syntax;';
    private string $accessDeniedErrorMessage = 'Access denied for user';
    private string $overwriteButton = '#step3Continue';
    private string $submitButton = '#step3Submit';
    private string $showPasswordButton = '#sDbPassCheckbox';
    private string $dbHostInput = '//input[@name="aDB[dbHost]"]';
    private string $dbPortInput = '//input[@name="aDB[dbPort]"]';
    private string $dbUserInput = '//input[@name="aDB[dbUser]"]';
    private string $dbNameInput = '//input[@name="aDB[dbName]"]';
    private string $demoDataOption = '//input[@name="aDB[dbiDemoData]"]';
    private string $dbPwdInput = '#sDbPassPlain';
    private string $disabledInstallDemoDataCheckbox = '//input[@type="radio" and @name="aDB[dbiDemoData]" and @value="1" and @disabled]';
    private string $checkedWithoutDemoDataCheckbox = '//input[@type="radio" and @name="aDB[dbiDemoData]" and @value="0" and @checked]';

    public function waitForStep(): static
    {
        $I = $this->user;

        $I->waitForElement($this->submitButton);

        return $this;
    }

    public function fillDatabaseConnectionFields(
        string $host,
        string $port,
        string $dbName,
        string $username,
        string $password
    ): static {
        $I = $this->user;

        $I->checkOption($this->showPasswordButton);

        $this->fillDbNameField($dbName);
        $this->fillDbUserField($username);
        $I->fillField($this->dbHostInput, $host);
        $I->fillField($this->dbPortInput, $port);
        $I->fillField($this->dbPwdInput, $password);

        return $this;
    }

    public function fillDbNameField(string $dbName): static
    {
        $I = $this->user;

        $I->fillField($this->dbNameInput, $dbName);
        $I->seeInField($this->dbNameInput, $dbName);

        return $this;
    }

    public function fillDbUserField(string $dbUser): static
    {
        $I = $this->user;

        $I->fillField($this->dbUserInput, $dbUser);
        $I->seeInField($this->dbUserInput, $dbUser);

        return $this;
    }

    public function dontInstallDemoData(): static
    {
        $I = $this->user;

        $I->selectOption($this->demoDataOption, '0');

        return $this;
    }

    public function installDemoData(): static
    {
        $I = $this->user;

        $I->selectOption($this->demoDataOption, '1');

        return $this;
    }

    public function submitForm(): static
    {
        $I = $this->user;

        $I->seeElement($this->submitButton);
        $I->click($this->submitButton);

        return $this;
    }

    public function goToDirectoryAndLoginStep(): DirectoryAndLoginStep
    {
        $this->submitForm();

        $directoryAndLoginStep = new DirectoryAndLoginStep($this->user);
        $directoryAndLoginStep->waitForStep();

        return $directoryAndLoginStep;
    }

    public function seeContinueButton(): static
    {
        $I = $this->user;

        $I->waitForElement($this->overwriteButton);

        return $this;
    }

    public function cannotSelectDemoDataInstallation(): static
    {
        $I = $this->user;

        $I->seeElement($this->disabledInstallDemoDataCheckbox);
        $I->seeElement($this->checkedWithoutDemoDataCheckbox);

        return $this;
    }

    public function seeFillAllFieldsErrorMessage(): static
    {
        $I = $this->user;

        $I->waitForText($this->fillAllFieldsErrorMessage);

        return $this;
    }

    public function seeAccessDeniedErrorMessage(): static
    {
        $I = $this->user;

        $I->waitForText($this->accessDeniedErrorMessage);

        return $this;
    }

    public function seeCantOpenSqlErrorMessage(): static
    {
        $I = $this->user;

        $I->waitForText($this->cannotOpenSqlErrorMessage);

        return $this;
    }

    public function seeSqlSyntaxErrorMessage(): static
    {
        $I = $this->user;

        $I->waitForText($this->sqlInsertingErrorMessage);
        $I->see($this->sqlSyntaxErrorMessage);

        return $this;
    }
}
