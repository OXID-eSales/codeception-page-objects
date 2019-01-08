<?php
namespace OxidEsales\Codeception\Page;

class Page
{
    protected $user;

    public function __construct(\AcceptanceTester $I)
    {
        $this->user = $I;
    }
}
