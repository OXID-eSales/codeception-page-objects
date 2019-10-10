<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Checkout;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for thank you page
 * @package OxidEsales\Codeception\Page\Checkout
 */
class ThankYou extends Page
{
    // include url of current page
    public $URL = '/index.php?cl=thankyou&lang=1';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $thankYouPage = '#thankyouPage';

    public function grabOrderNumber()
    {
        $I = $this->user;
        $I->waitForElementVisible($this->thankYouPage, 10);
        $thankYouText = $I->grabTextFrom($this->thankYouPage);
        $thankMessage = trim(sprintf(Translator::translate('REGISTERED_YOUR_ORDER'), ''));
        $result = preg_match_all("/$thankMessage\s*(?P<orderNumber>\d+)/", $thankYouText, $matches);
        $I->assertFalse(empty($result), "Order number is not empty");

        return $matches['orderNumber'][0];
    }
}
