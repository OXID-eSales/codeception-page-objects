<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Step;

class Step
{
    /**
     * @var \Codeception\Actor
     */
    protected $user;

    public function __construct(\Codeception\Actor $I)
    {
        $this->user = $I;
    }
}
