<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\ShopSetup\DataObject;

class UserInput
{
    private string $themeId;
    private string $dbHost;
    private int $dbPort;
    private string $dbName;
    private string $dbUserName;
    private string $dbUserPassword;

    public function getThemeId(): string
    {
        return $this->themeId;
    }

    public function setThemeId(string $themeId): void
    {
        $this->themeId = $themeId;
    }

    public function getDbHost(): string
    {
        return $this->dbHost;
    }

    public function setDbHost(string $dbHost): void
    {
        $this->dbHost = $dbHost;
    }

    public function getDbPort(): int
    {
        return $this->dbPort;
    }

    public function setDbPort(int $dbPort): void
    {
        $this->dbPort = $dbPort;
    }

    public function getDbName(): string
    {
        return $this->dbName;
    }

    public function setDbName(string $dbName): void
    {
        $this->dbName = $dbName;
    }

    public function getDbUserName(): string
    {
        return $this->dbUserName;
    }

    public function setDbUserName(string $dbUserName): void
    {
        $this->dbUserName = $dbUserName;
    }

    public function getDbUserPassword(): string
    {
        return $this->dbUserPassword;
    }

    public function setDbUserPassword(string $dbUserPassword): void
    {
        $this->dbUserPassword = $dbUserPassword;
    }
}
