<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\DataObject;

use function GuzzleHttp\Psr7\str;

/**
 * Class AdminUserForm
 */
class AdminUser
{
    /** @var bool */
    private $active;

    /** @var string */
    private $username;

    /** @var string */
    private $customerNumber;

    /** @var string */
    private $title;

    /** @var string */
    private $firstName;

    /** @var string */
    private $familyName;

    /** @var string */
    private $company;

    /** @var string */
    private $street;

    /** @var string */
    private $streetNumber;

    /** @var string */
    private $zipCode;

    /** @var string */
    private $city;

    /** @var string */
    private $ustid;

    /** @var string */
    private $additionalInfo;

    /** @var string */
    private $countryId;

    /** @var string */
    private $stateId;

    /** @var string */
    private $phone;

    /** @var string */
    private $fax;

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
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param string $firstName
     */
    public function setFistName(string $firstName): void
    {
        $this->firstName = $firstName;
    }

    /**
     * @return string|null
     */
    public function getFamilyName()
    {
        return $this->familyName;
    }

    /**
     * @param string $familyName
     */
    public function setFamilyName(string $familyName): void
    {
        $this->familyName = $familyName;
    }

    /**
     * @return string|null
     */
    public function getCompany(): ?string
    {
        return $this->company;
    }

    /**
     * @param string $company
     */
    public function setCompany(string $company): void
    {
        $this->company = $company;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @param string $street
     */
    public function setStreet(string $street): void
    {
        $this->street = $street;
    }

    /**
     * @return string|null
     */
    public function getStreetNumber(): ?string
    {
        return $this->streetNumber;
    }

    /**
     * @param string $streetNumber
     */
    public function setStreetNumber(string $streetNumber): void
    {
        $this->streetNumber = $streetNumber;
    }

    /**
     * @return string|null
     */
    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     */
    public function setZipCode(string $zipCode): void
    {
        $this->zipCode = $zipCode;
    }

    /**
     * @return string|null
     */
    public function getCity(): ?string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
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
    public function getAdditionalInfo(): ?string
    {
        return $this->additionalInfo;
    }

    /**
     * @param string $additionalInfo
     */
    public function setAdditionalInfo(string $additionalInfo): void
    {
        $this->additionalInfo = $additionalInfo;
    }

    /**
     * @return string|null
     */
    public function getCountryId(): ?string
    {
        return $this->countryId;
    }

    /**
     * @param string $countryId
     */
    public function setCountryId(string $countryId): void
    {
        $this->countryId = $countryId;
    }

    /**
     * @return string|null
     */
    public function getStateId(): ?string
    {
        return $this->stateId;
    }

    /**
     * @param string $stateId
     */
    public function setStateId(string $stateId): void
    {
        $this->stateId = $stateId;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone(string $phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return string|null
     */
    public function getFax(): ?string
    {
        return $this->fax;
    }

    /**
     * @param string $fax
     */
    public function setFax(string $fax): void
    {
        $this->fax = $fax;
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
