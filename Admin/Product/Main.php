<?php declare(strict_types=1);
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Admin\Product\Component\Footer;
use OxidEsales\Codeception\Admin\Product\Component\ListHeader;
use OxidEsales\Codeception\Page\Page;

/**
 * Class Main
 *
 * @package OxidEsales\Codeception\Admin\Product
 */
class Main extends Page
{
    use Footer, ListHeader;

    public $activeCheckbox = "//input[@name='editval[oxarticles__oxactive]'][@type='checkbox']";
    public $productTitle = "//input[@name='editval[oxarticles__oxtitle]']";
    public $productNumber = "//input[@name='editval[oxarticles__oxartnum]']";
    public $productPrice = "//input[@name='editval[oxarticles__oxprice]']";

    public $saveButton = "//input[@name='saveArticle']";

    /**
     * @param string      $title
     * @param string|null $number
     * @param int|null    $price
     *
     * @return Main
     */
    public function create(string $title, ?string $number = null, ?int $price = null): Main
    {
        $I = $this->user;

        $this->openNewProductForm();

        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->productTitle, $title);

        if ($number) {
            $I->fillField($this->productNumber, $number);
        }

        if ($price) {
            $I->fillField($this->productPrice, $price);
        }

        $I->waitForElementClickable($this->saveButton);
        $I->click($this->saveButton);
        // Wait for list and edit sections to load
        $I->selectEditFrame();
        $I->selectListFrame();

        return $this;
    }
}
