<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin;

use OxidEsales\Codeception\Module\Translation\Translator;

/**
 * Class Newsletter
 *
 * @package OxidEsales\Codeception\Admin
 */
class Newsletter extends \OxidEsales\Codeception\Page\Page
{
    /**
     * @return Newsletter
     */
    public function exportReciepents(): Newsletter
    {
        $I = $this->user;

        $I->click(Translator::translate('tbclnewsletter_recipients'));

        return $this;
    }
}
