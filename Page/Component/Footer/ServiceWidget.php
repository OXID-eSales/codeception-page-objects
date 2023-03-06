<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Page\Component\Footer;

use OxidEsales\Codeception\Module\Context;
use OxidEsales\Codeception\Page\Account\UserAccount;
use OxidEsales\Codeception\Page\Account\UserLogin;
use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\PrivateSales\Invitation;

/**
 * Trait for service menu widget in footer
 * @package OxidEsales\Codeception\Page\Component\Footer
 */
trait ServiceWidget
{
    public string $basketLink = '//ul[@class="services list-unstyled"]';

    public string $privateSalesInvitationLink = '//ul[@class="services list-unstyled"]';

    public string $userAccountPageLink = '//ul[@class="services list-unstyled"]';
    /**
     * @return Basket
     */
    public function openBasket(): Basket
    {
        $I = $this->user;
        $I->click(Translator::translate('CART'), $this->basketLink);
        $I->waitForPageLoad();
        return new Basket($I);
    }

    /**
     * @return Invitation
     */
    public function openPrivateSalesInvitationPage(): Invitation
    {
        $I = $this->user;
        $invitationPage = new Invitation($I);
        $I->click(Translator::translate('INVITE_YOUR_FRIENDS'), $this->privateSalesInvitationLink);
        $I->waitForText(Translator::translate('INVITE_YOUR_FRIENDS'));
        return $invitationPage;
    }

    public function openUserAccountPage(): UserAccount|UserLogin
    {
        $I = $this->user;
        $I->click(Translator::translate('ACCOUNT'), $this->userAccountPageLink);
        if (Context::isUserLoggedIn()) {
            return new UserAccount($I);
        } else {
            return new UserLogin($I);
        }
    }
}
