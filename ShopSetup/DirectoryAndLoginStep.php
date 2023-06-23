<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

class DirectoryAndLoginStep extends SetupStep
{
    private string $dataWasWrittenMessage = 'Check and writing data successful. Please wait';
    private string $updatingDatabaseMessage = 'Database successfully updated. Please wait';
    private string $fillAllFieldsErrorMessage = 'ERROR: Please fill in all needed fields!';
    private string $tooShortErrorMessage = 'Password is too short!';
    private string $notMatchErrorMessage = 'Passwords do not match!';
    private string $notValidEmailErrorMessage = 'Please enter a valid e-mail address!';
    private string $missingConfigFileErrorMessage = 'Could not open %s/config.inc.php for reading';
    private string $continueButton = '#step4Submit';
    private string $shopDirectoryInput = '//input[@name="aPath[sShopDir]"]';
    private string $loginNameInput = '//input[@name="aAdminData[sLoginName]"]';
    private string $loginPasswordInput = '//input[@name="aAdminData[sPassword]"]';
    private string $passwordConfirmationInput = '//input[@name="aAdminData[sPasswordConfirm]"]';
    private string $cannotOpenSqlErrorMessage = 'ERROR: Cannot open SQL file';
    private string $sqlInsertingErrorMessage = 'Issue while inserting this SQL statements:';
    private string $sqlSyntaxErrorMessage = 'You have an error in your SQL syntax;';

    public function getWaitForStepLoadElement(): string
    {
        return $this->continueButton;
    }

    public function proceedToShopLicenseStep(): ShopLicenseStep
    {
        $I = $this->user;
        $I->click($this->continueButton);
        $I->waitForText($this->dataWasWrittenMessage);
        $I->waitForText($this->updatingDatabaseMessage);

        return new ShopLicenseStep($this->user);
    }

    public function proceedToFinishStep(): FinishStep
    {
        $I = $this->user;
        $I->click($this->continueButton);
        $I->waitForText($this->dataWasWrittenMessage);
        $I->waitForText($this->updatingDatabaseMessage);

        return new FinishStep($this->user);
    }

    public function returnToDatabaseStepIfSqlSchemaIsMissing(): DatabaseStep
    {
        $I = $this->user;
        $I->click($this->continueButton);

        $I->waitForText($this->cannotOpenSqlErrorMessage);

        return new DatabaseStep($I);
    }

    public function returnToDirectoryAndLoginStepIfSqlSchemaIsCorrupt(): static
    {
        $I = $this->user;
        $I->click($this->continueButton);

        $I->waitForText($this->sqlInsertingErrorMessage);
        $I->waitForText($this->sqlSyntaxErrorMessage);

        return $this;
    }

    public function returnToDirectoryAndLoginStepIfFieldsAreEmpty(): static
    {
        $I = $this->user;
        $I->click($this->continueButton);

        $I->waitForText($this->fillAllFieldsErrorMessage);

        return $this;
    }

    public function returnToDirectoryAndLoginStepIfPasswordIsTooShort(): static
    {
        $I = $this->user;
        $I->click($this->continueButton);

        $I->waitForText($this->tooShortErrorMessage);

        return $this;
    }

    public function returnToDirectoryAndLoginStepIfPasswordsMismatch(): static
    {
        $I = $this->user;
        $I->click($this->continueButton);

        $I->waitForText($this->notMatchErrorMessage);

        return $this;
    }

    public function returnToDirectoryAndLoginStepIfInvalidEmail(): static
    {
        $I = $this->user;
        $I->click($this->continueButton);

        $I->waitForText($this->notValidEmailErrorMessage);

        return $this;
    }

    public function returnToDirectoryAndLoginStepIfInvalidShopDirectory(string $wrongDirectory): static
    {
        $I = $this->user;
        $I->click($this->continueButton);

        $I->waitForText(
            sprintf(
                $this->missingConfigFileErrorMessage,
                $wrongDirectory
            )
        );

        return $this;
    }

    public function fillAdminCredentials(string $username, string $password, string $passwordConfirmation): static
    {
        $I = $this->user;
        $I->fillField($this->loginNameInput, $username);
        $I->fillField($this->loginPasswordInput, $password);
        $I->fillField($this->passwordConfirmationInput, $passwordConfirmation);

        return $this;
    }

    public function setShopDirectory(string $source): static
    {
        $I = $this->user;
        $I->fillField($this->shopDirectoryInput, $source);

        return $this;
    }
}
