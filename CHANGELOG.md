# Change Log for OXID eShop Codeception Page Objects

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [Unreleased]

### Changed
- Update symfony components to version 5

### Removed
- Properties in `Page\Account\Component`
    - `AccountNavigation:$newsletterSettingsLink`
    - `AccountNavigation:$addressSettingsLink`
    - `AccountNavigation:$giftRegistryLink`
    - `AccountNavigation:$wishListLink`
    - `AccountNavigation:$listmaniaLink`

## [1.3.2] - unreleased

### Added
- Properties:
    - `OxidEsales\Codeception\Page\Component\UserForm::$userNameField`
- Methods:
    - `OxidEsales\Codeception\Page\Component\UserForm::modifyUserName`
    - `OxidEsales\Codeception\Step\Basket::addProductToBasketAndOpenUserCheckout`
    - `OxidEsales\Codeception\Step\Basket::addProductToBasketAndOpenBasket`

### Deprecated
- Methods:
    - `OxidEsales\Codeception\Step\Basket::addProductToBasketAndOpen`

## [1.3.1] - 2020-04-09

### Added
- Review elements:
    - Classes:
        - `Page\Account\MyReviews`
    - Traits:
        - `Page\Component\Modal`
        - `Page\Component\Pagination`
    - Methods in `Page\Account\Component`:
        - `AccountNavigation::openMyReviewsPage`
        - `AccountNavigation::dontSeeMyReviewsLink`
        - `AccountNavigation::dontSeeMyReviewsPageTitle`
        - `AccountNavigation::seeNumberOnMyReviewsBadge`
        - `AccountNavigation::dontSeeGiftRegistryLink`

### Deprecated
- Properties in `Page\Account\Component`
    - `AccountNavigation:$newsletterSettingsLink`
    - `AccountNavigation:$addressSettingsLink`
    - `AccountNavigation:$giftRegistryLink`
    - `AccountNavigation:$wishListLink`
    - `AccountNavigation:$listmaniaLink`

## [1.3.0] - 2020-03-12

### Added
- New traits
    - CurrencyMenu

- New methods
    - ProductSearchList::selectSorting

- New properties
    - AccountMenu::userAccount
    - AccountNavigation::accountMenu

## [1.2.0] - 2020-02-19

### Added
- Admin page objects
    - Orders
    
- New methods
    - ThankYou::grabOrderNumber
    - AdminMenu::openOrders
    - AdminMenu::openProducts

## [1.1.1] - 2020-02-07

### Fixed
- Variant selection

## [1.1.0] - 2019-11-07

### Added
- Admin page objects
    - Admin login page
    - Admin panel
    - Core settings
    - Module list
    - Product categories

- New page objects
    - Gift Selection
    - MultiShop Home page

- New methods
    - Basket::openGiftSelection
    - OrderCheckout::editUserAddress
    - OrderCheckout::editPaymentMethod
    - OrderCheckout::validatePaymentMethod
    - OrderCheckout::validateShippingMethod
    - OrderCheckout::validateCoupon
    - OrderCheckout::validateVat
    - OrderCheckout::validateOrderItems
    - UserAccount::openOrderHistory

### Fixed
- Improved tests stability by waiting for page to be loaded in a lot of places.
- Fix ProductDetails page object to work with fixed add/remove compare links.
- Improve password filling to work with improved javascript error displaying.

## [1.0.0] -  2019-07-26

### Added
- First version of the module introduced

[1.3.1]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.3.0..v1.3.1
[1.3.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.2.0..v1.3.0
[1.2.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.1.1..v1.2.0
[1.1.1]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.1.0..v1.1.1
[1.1.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.0.0..v1.1.0
[1.0.0]: https://github.com/OXID-eSales/codeception-page-object/compare/81ac79e25ab110042e4d4020fe0b42e68a475ad6..v1.0.0
