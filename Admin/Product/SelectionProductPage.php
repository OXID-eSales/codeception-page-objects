<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Admin\Component\AssignPopup;
use OxidEsales\Codeception\Admin\Product\Popup\AssignSelectionListsPopup;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

use function sprintf;

class SelectionProductPage extends Page
{
    use AssignPopup;
    use ProductList;

    private string $assignButton = 'input.edittext[type="button"][value="%s"]';

    public function openAssignSelectionListPopup(): AssignSelectionListsPopup
    {
        $I = $this->user;
        $this->openAssignPopup(
            sprintf(
                $this->assignButton,
                Translator::translate('ARTICLE_ATTRIBUTE_ASSIGNSELECTLIST')
            )
        );

        return new AssignSelectionListsPopup($I);
    }
}
