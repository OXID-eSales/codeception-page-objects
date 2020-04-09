<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Account;

use Codeception\Util\Locator;
use OxidEsales\Codeception\Page\Component\Modal;
use OxidEsales\Codeception\Page\Component\Pagination;
use OxidEsales\Codeception\Page\Page;

class MyReviews extends Page
{
    use Pagination;
    use Modal;

    public const URL = '/index.php?lang=1&cl=account_reviewlist';

    public $URL = self::URL;
    public $breadCrumb = '#breadcrumb';
    public $headerTitle = 'h1';
    private $reviewEntry = '[itemprop="review"]';
    private $deleteReviewBtn = '[itemprop="review"] button';

    /** @param int $cnt */
    public function seeNumberOfReviews(int $cnt): void
    {
        $I = $this->user;
        $I->seeNumberOfElements($this->reviewEntry, $cnt);
    }

    public function deleteFirstReviewInList(): void
    {
        $I = $this->user;
        $I->click(Locator::firstElement($this->deleteReviewBtn));
        $this->confirmDeletion();
    }
}
