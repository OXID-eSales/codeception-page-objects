<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Component;

use Codeception\Actor;
use OxidEsales\Codeception\Admin\DataObject\AdminUserExtendedInfo;

trait AdminUserExtendedInfoForm
{
    public $extendedInfoEveningPhoneField = 'editval[oxuser__oxprivfon]';
    public $extendedInfoCelluarPhoneField = 'editval[oxuser__oxmobfon]';
    public $extendedInfoRecievesNewsletterField = "/descendant::input[@name='editnews'][2]";
    public $extendedInfoEmailInvalidField = "/descendant::input[@name='emailfailed'][2]";
    public $extendedInfoCreditRatingField = 'editval[oxuser__oxboni]';
    public $extendedInfoUrlField = 'editval[oxuser__oxurl]';

    /**
     * @param Actor                 $I
     * @param AdminUserExtendedInfo $adminUserExtendedInfo
     */
    private function fillUserExtendedInfoForm(Actor $I, AdminUserExtendedInfo $adminUserExtendedInfo): void
    {
        $fillForm = new FillForm();

        if ($adminUserExtendedInfo->getEveningPhone() != null) {
            $fillForm->fillFormInput($I, $this->extendedInfoEveningPhoneField,
                $adminUserExtendedInfo->getEveningPhone());
        }

        if ($adminUserExtendedInfo->getCelluarPhone() != null) {
            $fillForm->fillFormInput($I, $this->extendedInfoCelluarPhoneField,
                $adminUserExtendedInfo->getCelluarPhone());
        }

        $fillForm->chooseFormCheckbox($I, $this->extendedInfoRecievesNewsletterField,
            $adminUserExtendedInfo->getRecievesNewsletter());

        $fillForm->chooseFormCheckbox($I, $this->extendedInfoEmailInvalidField,
            $adminUserExtendedInfo->getEmailInvalid());

        if ($adminUserExtendedInfo->getCreditRating() != null) {
            $fillForm->fillFormInput($I, $this->extendedInfoCreditRatingField,
                $adminUserExtendedInfo->getCreditRating());
        }

        if ($adminUserExtendedInfo->getUrl() != null) {
            $fillForm->fillFormInput($I, $this->extendedInfoUrlField, $adminUserExtendedInfo->getUrl());
        }
    }
}
