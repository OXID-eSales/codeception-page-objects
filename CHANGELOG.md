# Change Log for OXID eShop Codeception Page Objects

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

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

[1.1.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.0.0..master
[1.0.0]: https://github.com/OXID-eSales/codeception-page-object/compare/81ac79e25ab110042e4d4020fe0b42e68a475ad6..v1.0.0
