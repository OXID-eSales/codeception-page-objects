<?php
namespace OxidEsales\Codeception\Page;

class Page
{
    protected $user;

    public static $breadCrumb = '#breadcrumb';

    public function __construct(\AcceptanceTester $I)
    {
        $this->user = $I;
    }

    /**
     * @param string $breadCrumb
     *
     * @return $this
     */
    public function seeOnBreadCrumb($breadCrumb)
    {
        $I = $this->user;
        $I->assertContains($breadCrumb, $this->clearNewLines($I->grabTextFrom(static::$breadCrumb)));
        return $this;
    }

    /**
     * Removes \n signs and it leading spaces from string. Keeps only single space in the ends of each row.
     *
     * @param string $line Not formatted string (with spaces and \n signs).
     *
     * @return string Formatted string with single spaces and no \n signs.
     */
    private function clearNewLines($line)
    {
        return trim(preg_replace("/[\t\r\n]+/", '', $line));
    }

}
