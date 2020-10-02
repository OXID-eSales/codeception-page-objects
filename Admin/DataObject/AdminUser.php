<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\DataObject;

/**
 * Class AdminUserForm
 */
class AdminUser
{
    /** @var bool */
    private $active = false;

    /** @var string */
    private $username;

    /** @var string */
    private $customerNumber;

    /** @var string */
    private $ustid;

    /** @var string */
    private $birthday;

    /** @var string */
    private $birthMonth;

    /** @var string */
    private $birthYear;

    /** @var string */
    private $password;

    /** @var string */
    private $userRights;

    /**
     * @return bool
     */
    public function getActive(): bool
    {
        return $this->active;
    }

    /**
     * @param bool $active
     */
    public function setActive(bool $active): void
    {
        $this->active = $active;
    }

    /**
     * @return string|null
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    /**
     * @return string|null
     */
    public function getCustomerNumber(): ?string
    {
        return $this->customerNumber;
    }

    /**
     * @param string $customerNumber
     */
    public function setCustomerNumber(string $customerNumber): void
    {
        $this->customerNumber = $customerNumber;
    }

    /**
     * @return string|null
     */
    public function getUstid(): ?string
    {
        return $this->ustid;
    }

    /**
     * @param string $ustid
     */
    public function setUstid(string $ustid): void
    {
        $this->ustid = $ustid;
    }

    /**
     * @return string|null
     */
    public function getBirthday(): ?string
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday(string $birthday): void
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string|null
     */
    public function getBirthMonth(): ?string
    {
        return $this->birthMonth;
    }

    /**
     * @param string $birthMonth
     */
    public function setBirthMonth(string $birthMonth): void
    {
        $this->birthMonth = $birthMonth;
    }

    /**
     * @return string|null
     */
    public function getBirthYear(): ?string
    {
        return $this->birthYear;
    }

    /**
     * @param string $birthYear
     */
    public function setBirthYear(string $birthYear): void
    {
        $this->birthYear = $birthYear;
    }

    /**
     * @return string|null
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string|null
     */
    public function getUserRights(): ?string
    {
        return $this->userRights;
    }

    /**
     * @param string $userRights
     */
    public function setUserRights(string $userRights): void
    {
        $this->userRights = $userRights;
    }

}
