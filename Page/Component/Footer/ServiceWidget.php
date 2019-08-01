<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Component\Footer;

use OxidEsales\Codeception\Page\Checkout\Basket;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\PrivateSales\Invitation;

/**
 * Trait for service menu widget in footer
 * @package OxidEsales\Codeception\Page\Component\Footer
 */
trait ServiceWidget
{
    public $basketLink = '//ul[@class="services list-unstyled"]';

    public $privateSalesInvitationLink = '//ul[@class="services list-unstyled"]';

    /**
     * @return Basket
     */
    public function openBasket()
    {
        $I = $this->user;
        $I->click(Translator::translate('CART'), $this->basketLink);
        $I->waitForPageLoad();
        return new Basket($I);
    }

    /**
     * @return Invitation
     */
    public function openPrivateSalesInvitationPage()
    {
        $I = $this->user;
        $invitationPage = new Invitation($I);
        $I->click(Translator::translate('INVITE_YOUR_FRIENDS'), $this->privateSalesInvitationLink);
        $I->waitForText(Translator::translate('INVITE_YOUR_FRIENDS'));
        return $invitationPage;
    }
}
