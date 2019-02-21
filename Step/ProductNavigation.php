<?php
/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

namespace OxidEsales\Codeception\Step;

use OxidEsales\Codeception\Page\ProductDetails;

class ProductNavigation extends \OxidEsales\EshopCommunity\Tests\Codeception\AcceptanceTester
{

    /**
     * Open product details page.
     *
     * @param string $productId The Id of the product
     *
     * @return ProductDetails
     */
    public function openProductDetailsPage($productId)
    {
        $I = $this;

        $I->amOnPage(ProductDetails::route($productId));
        return new ProductDetails($I);
    }
}