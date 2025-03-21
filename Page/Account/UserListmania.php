<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Account\Component\AccountNavigation;
use OxidEsales\Codeception\Page\Component\Header\AccountMenu;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for my-listmania-list page
 * @package OxidEsales\Codeception\Page\Account
 */
class UserListmania extends Page
{
    use AccountNavigation;
    use AccountMenu;

    // include url of current page
    public string $URL = '/en/my-listmania-list/';

    public string $breadCrumb = '.breadcrumb';

    public $headerTitle = 'h1';

    public $listmaniaTitleField = 'recomm_title';

    public $listmaniaAuthorField = 'recomm_author';

    public $listmaniaDescriptionField = 'recomm_desc';

    public $listmaniaListTitle = '//ul[@id="recommendationsLists"]//a[@title="%s"]';

    /**
     * @param string $title
     * @param string $author
     * @param string $description
     *
     * @return $this
     */
    public function createNewList(string $title, string $author = '', string $description = '')
    {
        $I = $this->user;
        $I->fillField($this->listmaniaTitleField, $title);
        if (!empty($author)) {
            $I->fillField($this->listmaniaAuthorField, $author);
        }
        $I->fillField($this->listmaniaDescriptionField, $description);
        $I->clickAndWait(Translator::translate('SAVE'));

        return $this;
    }

    /**
     * @param string $title
     *
     * @return $this
     */
    public function openListByTitle(string $title)
    {
        $I = $this->user;
        $I->clickAndWait(sprintf($this->listmaniaListTitle, $title));

        return $this;
    }

    /**
     * @param string $title
     * @param string $author
     * @param string $description
     *
     * @return $this
     */
    public function seeListData(string $title, string $author = '', string $description = '')
    {
        $I = $this->user;
        $I->seeText($description);
        $I->seeText($title . ' ' . Translator::translate('LIST_BY') . ' ' . $author);
        return $this;
    }
}
