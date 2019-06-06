<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\PrivateSales;

use OxidEsales\Codeception\Page\Component\UserForm;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for open-account page
 * @package OxidEsales\Codeception\Page\Account
 */
class Registration extends Page
{
    use UserForm;

    // include url of current page
    public $URL = '/en/open-account';

    //save form button
    public $saveFormButton = '#accUserSaveTop';

    public $confirmAGBOption = '#orderConfirmAgbBottom';

    public $confirmNewsletter = 'blnewssubscribed';

    /**
     * @return $this
     */
    public function registerUser()
    {
        $I = $this->user;
        $I->click($this->saveFormButton);
        $I->waitForPageLoad();
        return $this;
    }

    /**
     * @return $this
     */
    public function confirmAGB()
    {
        $I = $this->user;
        $I->checkOption($this->confirmAGBOption);
        return $this;
    }

    /**
     * @return $this
     */
    public function confirmNewsletterSubscription()
    {
        $I = $this->user;
        $I->checkOption($this->confirmNewsletter);
        return $this;
    }
}
