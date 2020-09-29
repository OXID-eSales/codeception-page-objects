<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\Component\AdminUserExtendedInfoForm;
use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;
use OxidEsales\Codeception\Admin\DataObject\AdminUserExtendedInfo;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class ExtendedInformationPage
 *
 * @package OxidEsales\Codeception\Admin\User
 */
class ExtendedInformationPage extends Page
{
    use UserList;
    use AdminUserExtendedInfoForm;

    public $extendedTabUserAddress = "#test_userAddress";
    public $extendedInfoTabUserAddress = "#test_userAddress";

    /**
     * @param AdminUserExtendedInfo $adminUserExtendedInfo
     * @return $this
     */
    public function editExtendedInfo(AdminUserExtendedInfo $adminUserExtendedInfo): self
    {
        $I = $this->user;
        $I->selectEditFrame();

        $this->fillUserExtendedInfoForm($I, $adminUserExtendedInfo);
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->selectEditFrame();

        return $this;
    }

    /**
     * @param AdminUserAddresses $adminUserAddress
     * @return $this
     */
    public function seeUserAddress(AdminUserAddresses $adminUserAddress): self
    {
        $addressInformation = $adminUserAddress->getTitle() . ' '
            . $adminUserAddress->getFirstName() . ' '
            . $adminUserAddress->getLastName() . ' '
            . $adminUserAddress->getCompany() . ' '
            . $adminUserAddress->getStreet() . ' '
            . $adminUserAddress->getStreetNumber() . ' '
            . $adminUserAddress->getStateId() . ' '
            . $adminUserAddress->getZip() . ' '
            . $adminUserAddress->getCity() . ' '
            . $adminUserAddress->getAdditionalInfo() . ' '
            . $adminUserAddress->getCountryId() . ' '
            . $adminUserAddress->getPhone();
        $I = $this->user;
        $I->see($addressInformation, $this->extendedInfoTabUserAddress);
        return $this;
    }

    /**
     * @param AdminUserExtendedInfo $adminUserExtendedInfo
     * @return $this
     */
    public function seeUserExtendedInformation(AdminUserExtendedInfo $adminUserExtendedInfo)
    {
        $I = $this->user;
        $I->seeInField($this->extendedInfoEveningPhoneField, $adminUserExtendedInfo->getEveningPhone());
        $I->seeInField($this->extendedInfoCelluarPhoneField, $adminUserExtendedInfo->getCelluarPhone());
        if ($adminUserExtendedInfo->getEmailInvalid()) {
            $I->seeCheckboxIsChecked($this->extendedInfoEmailInvalidField);
        } else {
            $I->dontSeeCheckboxIsChecked($this->extendedInfoEmailInvalidField);
        }
        if ($adminUserExtendedInfo->getRecievesNewsletter()) {
            $I->seeCheckboxIsChecked($this->extendedInfoRecievesNewsletterField);
        } else {
            $I->dontSeeCheckboxIsChecked($this->extendedInfoRecievesNewsletterField);
        }
        $I->seeInField($this->extendedInfoCreditRatingField, $adminUserExtendedInfo->getCreditRating());
        $I->seeInField($this->extendedInfoUrlField, $adminUserExtendedInfo->getUrl());
        return $this;
    }
}
