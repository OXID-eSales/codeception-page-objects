<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\DataObject;

class AdminUser
{
    private bool $active = false;
    private string $username = '';
    private string $customerNumber = '';
    private string $ustid = '';
    private string $birthday = '';
    private string $birthMonth = '';
    private string $birthYear = '';
    private string $password = '';
    private string $userRights = '';

    public function getActive(): bool
    {
        return $this->active;
    }

    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function getCustomerNumber(): string
    {
        return $this->customerNumber;
    }

    public function setCustomerNumber(string $customerNumber): void
    {
        $this->customerNumber = $customerNumber;
    }

    public function getUstid(): string
    {
        return $this->ustid;
    }

    public function setUstid(string $ustid): void
    {
        $this->ustid = $ustid;
    }

    public function getBirthday(): string
    {
        return $this->birthday;
    }

    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    public function getBirthMonth(): string
    {
        return $this->birthMonth;
    }

    public function setBirthMonth(string $birthMonth): void
    {
        $this->birthMonth = $birthMonth;
    }

    public function getBirthYear(): string
    {
        return $this->birthYear;
    }

    public function setBirthYear(string $birthYear): void
    {
        $this->birthYear = $birthYear;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getUserRights(): string
    {
        return $this->userRights;
    }

    public function setUserRights(string $userRights): void
    {
        $this->userRights = $userRights;
    }

}
