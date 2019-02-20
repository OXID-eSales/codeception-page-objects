<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Step;

use OxidEsales\Codeception\Page\Details\ProductDetails;

/**
 * Class ProductNavigation
 * @package OxidEsales\Codeception\Step
 */
class ProductNavigation extends Step
{
    /**
     * Open product details page.
     *
     * @param string $productId The Id of the product
     *
     * @return ProductDetails
     */
    public function openProductDetailsPage(string $productId)
    {
        $I = $this->user;
        $productDetailsPage = new ProductDetails($I);
        $I->amOnPage($productDetailsPage->route($productId));
        return $productDetailsPage;
    }
}
