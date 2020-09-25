<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\DataObject;

/**
 * Class AdminUserExtendedInfo
 */
class AdminUserExtendedInfo
{
    /** @var string */
    private $eveningPhone;

    /** @var string */
    private $celluarPhone;

    /** @var bool */
    private $recievesNewsletter = false;

    /** @var bool */
    private $emailInvalid = false;

    /** @var string */
    private $creditRating;

    /** @var string */
    private $url;

    /**
     * @return string|null
     */
    public function getEveningPhone(): ?string
    {
        return $this->eveningPhone;
    }

    /**
     * @param string $eveningPhone
     */
    public function setEveningPhone(string $eveningPhone): void
    {
        $this->eveningPhone = $eveningPhone;
    }

    /**
     * @return string|null
     */
    public function getCelluarPhone(): ?string
    {
        return $this->celluarPhone;
    }

    /**
     * @param string $celluarPhone
     */
    public function setCelluarPhone(string $celluarPhone): void
    {
        $this->celluarPhone = $celluarPhone;
    }

    /**
     * @return bool
     */
    public function getRecievesNewsletter(): bool
    {
        return $this->recievesNewsletter;
    }

    /**
     * @param bool $recievesNewsletter
     */
    public function setRecievesNewsletter(bool $recievesNewsletter): void
    {
        $this->recievesNewsletter = $recievesNewsletter;
    }

    /**
     * @return bool
     */
    public function getEmailInvalid(): bool
    {
        return $this->emailInvalid;
    }

    /**
     * @param bool $emailInvalid
     */
    public function setEmailInvalid(bool $emailInvalid): void
    {
        $this->emailInvalid = $emailInvalid;
    }

    /**
     * @return string|null
     */
    public function getCreditRating(): ?string
    {
        return $this->creditRating;
    }

    /**
     * @param string $creditRating
     */
    public function setCreditRating(string $creditRating): void
    {
        $this->creditRating = $creditRating;
    }

    /**
     * @return string|null
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
}
