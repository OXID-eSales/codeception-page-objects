<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\DataObject;

class AdminUserExtendedInfo
{
    private string $eveningPhone = '';
    private string $cellularPhone = '';
    private bool $receivesNewsletter = false;
    private bool $emailInvalid = false;
    private string $creditRating = '';
    private string $url = '';

    public function getEveningPhone(): ?string
    {
        return $this->eveningPhone;
    }

    public function setEveningPhone(string $eveningPhone): void
    {
        $this->eveningPhone = $eveningPhone;
    }

    public function getCellularPhone(): ?string
    {
        return $this->cellularPhone;
    }

    public function setCellularPhone(string $cellularPhone): void
    {
        $this->cellularPhone = $cellularPhone;
    }

    public function getReceivesNewsletter(): bool
    {
        return $this->receivesNewsletter;
    }

    public function setReceivesNewsletter(bool $receivesNewsletter): void
    {
        $this->receivesNewsletter = $receivesNewsletter;
    }

    public function getEmailInvalid(): bool
    {
        return $this->emailInvalid;
    }

    public function setEmailInvalid(bool $emailInvalid): void
    {
        $this->emailInvalid = $emailInvalid;
    }

    public function getCreditRating(): string
    {
        return $this->creditRating;
    }

    public function setCreditRating(string $creditRating): void
    {
        $this->creditRating = $creditRating;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
