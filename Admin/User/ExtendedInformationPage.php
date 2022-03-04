<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\User;

use OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses;
use OxidEsales\Codeception\Admin\DataObject\AdminUserExtendedInfo;
use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

class ExtendedInformationPage extends Page
{
    use UserList;

    public $extendedInfoTabUserAddress = "#test_userAddress";
    public string $extendedInfoEveningPhoneField = "//input[@name='editval[oxuser__oxprivfon]']";
    public string $extendedInfoCellularPhoneField = "//input[@name='editval[oxuser__oxmobfon]']";
    public string $extendedInfoReceivesNewsletterField = "/descendant::input[@name='editnews'][2]";
    public string $extendedInfoEmailInvalidField = "/descendant::input[@name='emailfailed'][2]";
    public string $extendedInfoCreditRatingField = "//input[@name='editval[oxuser__oxboni]']";
    public string $extendedInfoUrlField = "//input[@name='editval[oxuser__oxurl]']";

    /**
     * @param AdminUserExtendedInfo $adminUserExtendedInfo
     * @return $this
     */
    public function editExtendedInfo(AdminUserExtendedInfo $adminUserExtendedInfo): self
    {
        $I = $this->user;

        $I->fillField($this->extendedInfoEveningPhoneField, $adminUserExtendedInfo->getEveningPhone());
        $I->fillField($this->extendedInfoCellularPhoneField, $adminUserExtendedInfo->getCelluarPhone());
        if ($adminUserExtendedInfo->getRecievesNewsletter()) {
            $I->checkOption($this->extendedInfoReceivesNewsletterField);
        } else {
            $I->uncheckOption($this->extendedInfoReceivesNewsletterField);
        }
        if ($adminUserExtendedInfo->getEmailInvalid()) {
            $I->checkOption($this->extendedInfoEmailInvalidField);
        } else {
            $I->uncheckOption($this->extendedInfoEmailInvalidField);
        }
        $I->fillField($this->extendedInfoCreditRatingField, $adminUserExtendedInfo->getCreditRating());
        $I->fillField($this->extendedInfoUrlField, $adminUserExtendedInfo->getUrl());
        $I->click(Translator::translate('GENERAL_SAVE'));
        $I->waitForDocumentReadyState();

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
        $I->seeInField($this->extendedInfoCellularPhoneField, $adminUserExtendedInfo->getCelluarPhone());
        if ($adminUserExtendedInfo->getEmailInvalid()) {
            $I->seeCheckboxIsChecked($this->extendedInfoEmailInvalidField);
        } else {
            $I->dontSeeCheckboxIsChecked($this->extendedInfoEmailInvalidField);
        }
        if ($adminUserExtendedInfo->getRecievesNewsletter()) {
            $I->seeCheckboxIsChecked($this->extendedInfoReceivesNewsletterField);
        } else {
            $I->dontSeeCheckboxIsChecked($this->extendedInfoReceivesNewsletterField);
        }
        $I->seeInField($this->extendedInfoCreditRatingField, $adminUserExtendedInfo->getCreditRating());
        $I->seeInField($this->extendedInfoUrlField, $adminUserExtendedInfo->getUrl());
        return $this;
    }
}
