<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup;

use OxidEsales\Codeception\Page\Page;

class DirectoryAndLoginStep extends Page
{
    private string $url = '/Setup/index.php?istep=500';
    private string $dataWasWrittenMessage = 'Check and writing data successful. Please wait ...';
    private string $updatingDatabaseMessage = 'Database successfully updated. Please wait ...';
    private string $fillAllFieldsErrorMessage = 'ERROR: Please fill in all needed fields!';
    private string $tooShortErrorMessage = 'Password is too short!';
    private string $notMatchErrorMessage = 'Passwords do not match!';
    private string $notValidEmailErrorMessage = 'Please enter a valid e-mail address!';
    private string $missingConfigFileErrorMessage = 'Could not open %s for reading! Please consult our FAQ, forum or contact OXID Support staff!';
    private string $submitButton = '#step4Submit';
    private string $shopDirectoryInput = '//input[@name="aPath[sShopDir]"]';
    private string $loginNameInput = '//input[@name="aAdminData[sLoginName]"]';
    private string $loginPasswordInput = '//input[@name="aAdminData[sPassword]"]';
    private string $passwordConfirmationInput = '//input[@name="aAdminData[sPasswordConfirm]"]';

    public function openTab(): static
    {
        $I = $this->user;

        $I->amOnPage($this->url);
        $I->seeElement($this->submitButton);

        return $this;
    }

    public function waitForStep(): static
    {
        $I = $this->user;

        $I->waitForElement($this->submitButton);

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

    public function fillSourceField(string $source): static
    {
        $I = $this->user;

        $I->fillField($this->shopDirectoryInput, $source);

        return $this;
    }

    public function submitForm(): static
    {
        $I = $this->user;

        $I->seeElement($this->submitButton);
        $I->click($this->submitButton);

        return $this;
    }

    public function goToFinalStep(): FinishStep
    {
        $I = $this->user;

        $this->submitForm();

        $I->waitForText($this->dataWasWrittenMessage);
        $I->waitForText($this->updatingDatabaseMessage);

        $finalStep = new FinishStep($this->user);
        $finalStep->seeAdminLink();

        return $finalStep;
    }

    public function goToShopLicenseStep(): ShopLicenseStep
    {
        $I = $this->user;

        $this->submitForm();
        $I->waitForText($this->dataWasWrittenMessage);
        $I->waitForText($this->updatingDatabaseMessage);

        $shopLicenseStep = new ShopLicenseStep($this->user);
        $shopLicenseStep->waitForStep();

        return $shopLicenseStep;
    }

    public function seeFillAllFieldsErrorMessage(): static
    {
        $I = $this->user;

        $I->see($this->fillAllFieldsErrorMessage);

        return $this;
    }

    public function seeTooShortPasswordErrorMessage(): static
    {
        $I = $this->user;

        $I->see($this->tooShortErrorMessage);

        return $this;
    }

    public function seePasswordsNotMatchedErrorMessage(): static
    {
        $I = $this->user;

        $I->see($this->notMatchErrorMessage);

        return $this;
    }

    public function seeNotValidEmailErrorMessage(): static
    {
        $I = $this->user;

        $I->see($this->notValidEmailErrorMessage);

        return $this;
    }

    public function seeMissingConfigErrorMessage(string $configPath): static
    {
        $I = $this->user;

        $I->see(
            sprintf($this->missingConfigFileErrorMessage, $configPath)
        );

        return $this;
    }
}
