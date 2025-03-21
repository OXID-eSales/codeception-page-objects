<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Footer;

use Codeception\Util\Locator;
use OxidEsales\Codeception\Module\Context;
use OxidEsales\Codeception\Page\Account\UserAccount;
use OxidEsales\Codeception\Page\Account\UserLogin;
use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Info\ContactPage;

trait ServiceWidget
{
    public string $basketLink = '//div[@class="footer-content"]';

    public string $userAccountPageLink = '//div[@class="footer-content"]';

    public function openBasket(): Basket
    {
        $I = $this->user;
        $I->clickAndWait(Translator::translate('CART'), $this->basketLink);

        return new Basket($I);
    }

    public function openUserAccountPage()
    {
        $I = $this->user;
        $I->clickAndWait(
            Translator::translate('ACCOUNT'),
            Locator::elementAt($this->userAccountPageLink, 1)
        );

        return Context::isUserLoggedIn() ?
            new UserAccount($I) :
            new UserLogin($I);
    }

    public function openContactPage(): ContactPage
    {
        $I = $this->user;
        $I->clickAndWait(Translator::translate('CONTACT'));

        return new ContactPage($I);
    }
}
