<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page\Details;

use OxidEsales\Codeception\Module\Translation\Translator;
use OxidEsales\Codeception\Page\Page;

/**
 * Class for recommend page.
 * @package OxidEsales\Codeception\Page\Details
 */
class ProductSuggestion extends Page
{
    // include url of current page
    public $URL = '/en/recommend/';

    // include bread crumb of current page
    public $breadCrumb = '#breadcrumb';

    public $headerTitle = 'h1';

    public $recipientName = 'editval[rec_name]';

    public $recipientEmail = 'editval[rec_email]';

    public $senderName = 'editval[send_name]';

    public $senderEmail = 'editval[send_email]';

    public $emailSubject = 'editval[send_subject]';

    public $emailMessage = 'editval[send_message]';

    /**
     * @param mixed $param
     *
     * @return string
     */
    public function route($param)
    {
        return $this->URL.'/index.php?'.http_build_query(['anid' => $param]);
    }

    /**
     * Send suggestion email.
     * $suggestionEmailData = [
     * 'recipient_name',
     * 'recipient_email',
     * 'sender_name',
     * 'sender_email',
     * 'message',
     * 'subject'
     * ]
     *
     *
     * @param array $suggestionEmailData
     *
     * @return $this
     */
    public function sendSuggestionEmail($suggestionEmailData)
    {
        $I = $this->user;
        $I->fillField($this->recipientName, $suggestionEmailData['recipient_name']);
        $I->fillField($this->recipientEmail, $suggestionEmailData['recipient_email']);
        $I->fillField($this->senderName, $suggestionEmailData['sender_name']);
        $I->fillField($this->senderEmail, $suggestionEmailData['sender_email']);
        if (isset($suggestionEmailData['message'])) {
            $I->fillField($this->emailMessage, $suggestionEmailData['message']);
        }
        if (isset($suggestionEmailData['subject'])) {
            $I->fillField($this->emailSubject, $suggestionEmailData['subject']);
        }
        $I->click(Translator::translate('SEND'));
        return $this;
    }
}
