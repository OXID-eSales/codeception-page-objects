<?php
namespace OxidEsales\Page;

use OxidEsales\Page\Footer\NewsletterBox;
use OxidEsales\Page\Header\AccountMenu;
use OxidEsales\Page\Header\MiniBasket;
use OxidEsales\Page\Header\Navigation;
use OxidEsales\Page\Header\SearchWidget;

class Home extends Page
{
    use AccountMenu, NewsletterBox, SearchWidget, Navigation, MiniBasket;

    // include url of current page
    public static $URL = '/';

    /**
     * Basic route example for your current URL
     * You can append any additional parameter to URL
     * and use it in tests like: Page\Edit::route('/123-post');
     */
    public static function route($param)
    {
        return static::$URL.$param;
    }
}
