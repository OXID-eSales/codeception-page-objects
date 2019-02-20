<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Page;

/**
 * Class Page
 * @package OxidEsales\Codeception\Page
 */
class Page
{
    /**
     * @var \Codeception\Actor
     */
    protected $user;

    /**
     * @var string
     */
    public $URL = '';

    /**
     * @var string
     */
    public $breadCrumb = '#breadcrumb';

    /**
     * Page constructor.
     *
     * @param \Codeception\Actor $I
     */
    public function __construct(\Codeception\Actor $I)
    {
        $this->user = $I;
    }

    /**
     * @param mixed $params
     *
     * @return string
     */
    public function route($params)
    {
        return $this->URL.'/index.php?'.http_build_query($params);
    }

    /**
     * @param string $breadCrumb
     *
     * @return $this
     */
    public function seeOnBreadCrumb(string $breadCrumb)
    {
        $I = $this->user;
        $I->assertContains($breadCrumb, $this->clearNewLines($I->grabTextFrom($this->breadCrumb)));
        return $this;
    }

    /**
     * Removes \n signs and it leading spaces from string. Keeps only single space in the ends of each row.
     *
     * @param string $line Not formatted string (with spaces and \n signs).
     *
     * @return string Formatted string with single spaces and no \n signs.
     */
    private function clearNewLines(string $line)
    {
        return trim(preg_replace("/[\t\r\n]+/", '', $line));
    }
}
