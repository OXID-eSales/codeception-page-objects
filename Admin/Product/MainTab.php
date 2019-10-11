<?php declare(strict_types=1);
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Page\Page;

/**
 * Class MainTab
 *
 * @package OxidEsales\Codeception\Admin\Product
 */
class MainTab extends Page
{
    public $activeCheckbox = "//input[@name='editval[oxarticles__oxactive]'][@type='checkbox']";
    public $titleInput = "//input[@name='editval[oxarticles__oxtitle]']";
    public $numberInput = "//input[@name='editval[oxarticles__oxartnum]']";
    public $priceInput = "//input[@name='editval[oxarticles__oxprice]']";

    public $createButton = "//a[@id='btn.new']";
    public $saveButton = "//input[@name='saveArticle']";

    /**
     * @param string      $title
     * @param string|null $number
     * @param int|null    $price
     *
     * @return MainTab
     */
    public function create(string $title, ?string $number = null, ?int $price = null): MainTab
    {
        $I = $this->user;

        $I->selectEditFrame();
        $I->click($this->createButton);
        // Wait for list and edit sections to load
        $I->selectListFrame();
        $I->selectEditFrame();

        $I->checkOption($this->activeCheckbox);
        $I->fillField($this->titleInput, $title);

        if ($number) {
            $I->fillField($this->numberInput, $number);
        }

        if ($price) {
            $I->fillField($this->priceInput, $price);
        }

        $I->waitForElementClickable($this->saveButton);
        $I->click($this->saveButton);
        // Wait for list and edit sections to load
        $I->selectEditFrame();
        $I->selectListFrame();

        return $this;
    }
}
