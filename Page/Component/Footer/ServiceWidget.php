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
use OxidEsales\Codeception\Page\Page;
use OxidEsales\Codeception\Page\PrivateSales\Invitation;
use Prophecy\Argument\Token\LogicalNotToken;

/**
 * Trait for service menu widget in footer
 * @package OxidEsales\Codeception\Page\Component\Footer
 */
trait ServiceWidget
{
    public string $basketLink = '//div[@class="footer-content"]';

    public string $privateSalesInvitationLink = '//div[@class="footer-content"]';

    public string $userAccountPageLink = '//div[@class="footer-content"]';
    /**
     * @return Basket
     */
    public function openBasket(): Basket
    {
        $I = $this->user;
        $I->retryClick(Translator::translate('CART'), $this->basketLink);
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
        $I->retryClick(Translator::translate('INVITE_YOUR_FRIENDS'), Locator::elementAt($this->privateSalesInvitationLink, 1));
        $I->waitForText(Translator::translate('INVITE_YOUR_FRIENDS'));
        return $invitationPage;
    }

    public function openUserAccountPage()
    {
        $I = $this->user;
        $I->retryClick(Translator::translate('ACCOUNT'), Locator::elementAt($this->userAccountPageLink, 1));
        if (Context::isUserLoggedIn()) {
            return new UserAccount($I);
        } else {
            return new UserLogin($I);
        }
    }
}
