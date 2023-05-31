# Change Log for OXID eShop Codeception Page Objects

All notable changes to this project will be documented in this file.
The format is based on [Keep a Changelog](http://keepachangelog.com/)
and this project adheres to [Semantic Versioning](http://semver.org/).

## [v4.2.0] - unreleased

### Added
- Traits:
  - `OxidEsales\Codeception\Page\Component\CookieNotice`
- Methods:
  - `OxidEsales\Codeception\Page\Component\CookieNotice::closeCookieNotice`
  - `OxidEsales\Codeception\Page\Component\CookieNotice::seeRejectInfo`
  - `OxidEsales\Codeception\Page\Component\CookieNotice::rejectCookies`
  - `OxidEsales\Codeception\Page\Component\CookieNotice::seeCookieNotice`
  - `OxidEsales\Codeception\Page\Component\CookieNotice::dontSeeCookieNotice`

### Changed
- Page objects:
  - `OxidEsales\Codeception\Page\Page`

## [v4.1.0] - 2023-05-09

### Fixed
- Checks for Page objects' availability

### Added
- Page objects:
  - `Admin\Manufacturer`
  - `Admin\Service\GenericExport`
  - `Admin\Service\GenericImport`
  - `Page\Lists\DistributorList`
  - `Page\Lists\ManufacturerList`
  - `Admin\CoreSetting\SEOTab`
- Traits:
  - `Page\Component\Footer\CategoryWidget`
  - `Page\Component\Footer\InformationWidget`
  - `Page\Component\Footer\ManufacturerWidget`
  - `Page\Component\Footer\Footer`
  - `Page\Component\Header\Header`
- Methods:
  - `Admin\Service\Tools:runSqlUpdate()`
  - `Admin\Service\Tools:seeInSqlOutput()`
  - `Admin\Component\AdminMenu::openGenericExport()`
  - `Admin\Component\AdminMenu::openGenericImport()`
  - `Page\Component\Modal::closeModalBox()`
  - `Page\Component\Header\AccountMenu::seeUserLoggedIn()`
  - `Page\Component\Header\AccountMenu::seeUserLoggedOut()`
  - `Page\Component\Header\MiniBasket::closeMiniBasket()`
  - `Page\Component\Footer\ServiceWidget:openUserAccountPage()`
  - `Page\Component\Modal:confirmMainCategoryChanged()`
  - `Page\Component\Modal:openBasketIfMainCategoryChanged()`
  - `Page\Account\UserPasswordReminder::seePageOpened()`
  - `Page\Account\UserRegistration::seePageOpened()`
  - `Page\Account\UserWishList::seePageOpened()`
  - `Page\Account\UserAccount::seePageOpened()`
  - `Page\Account\UserAccount::seeUserAccount()`
  - `Page\Account\UserAccount::seeItemNumberOnGiftRegistryPanel()`
  - `Page\Account\UserAccount::seeItemNumberOnReviewPanel()`
  - `Page\Account\UserAccount::openMyReviewsPage()`
  - `Page\Account\UserLogin::loginWithError()`
  - `Page\Account\UserLogin:seePageOpened()`
  - `Page\Checkout\Basket::seeBasketContainsAttribute()`
  - `Page\Checkout\Basket::seeBasketContainsSelectionList()`
  - `Page\Checkout\Basket::seeNextStep()`
  - `Page\Checkout\Basket::dontSeeNextStep()`
  - `Page\Checkout\OrderCheckout::submitOrderSuccessfully()`
  - `Page\Checkout\OrderCheckout::confirmDownloadableProductsAgreement()`
  - `Page\Checkout\OrderCheckout::editShippingMethod()`
  - `Page\Checkout\OrderCheckout::validateTotalPrice()`
  - `Page\Checkout\OrderCheckout::validateWrappingPrice()`
  - `Page\Checkout\OrderCheckout::validateGiftCardPrice()`
  - `Page\Lists\ProductList::seeProductDataInDisplayTypeList()`
  - `Page\Lists\ProductList::seeSelectedFilter()`
  - `Page\Lists\ProductList::dontSeeSelectedFilter()`
  - `Page\Home::openManufacturerFromStarPage()`
### Deprecated
- `Page\Lists\ProductList::openDetailsPage()`

## [v4.0.1] - 2022-11-23

### Fixed
- Checks for Page objects' availability

## [v4.0.0] - 2022-10-28

### Added
- Compatibility with Codeception v5

### Removed
- `Admin\Component\AdminUserAddressesForm`
- `Admin\Component\AdminUserExtendedInfoForm`
- `Admin\Component\AdminUserForm`
- `Admin\Component\FillForm`
- `Admin\Tools`

## [v3.0.0] - 2021-07-06

### Changed
- Update symfony components to version 5

### Removed
- Properties in `Page\Account\Component`
    - `AccountNavigation:$newsletterSettingsLink`
    - `AccountNavigation:$addressSettingsLink`
    - `AccountNavigation:$giftRegistryLink`
    - `AccountNavigation:$wishListLink`
    - `AccountNavigation:$listmaniaLink`
- Methods:
    - `OxidEsales\Codeception\Step\Basket::addProductToBasketAndOpen`

## [v2.3.0] - 2022-07-19

### Added
- Page objects:
  - `Admin\Service\SystemHealth`
  - `Admin\Service\SystemInfo`
  - `Admin\Service\Tools`
- Check for page object availability in:
  - `Page\Lists\ProductList::openDetailsPage()`
- Properties with input selectors in:
  - `Admin\User\ExtendedInformationPage`
  - `Admin\User\MainUserPage`
  - `Admin\User\UserAddressPage`
- Methods:
  - `Admin\User\MainUserPage::editUserInformation()`
  - `Admin\User\UserAddressPage::editUserAddress()`
- Trait:
  - `Admin\Component\FrameLoader`

### Deprecated
- Page object:
  - `Admin\Component\AdminUserAddressesForm`
  - `Admin\Component\AdminUserExtendedInfoForm`
  - `Admin\Component\AdminUserForm`
  - `Admin\Component\FillForm`
  - `Admin\Tools`

## [v2.2.0] - 2021-11-26

### Added
- Trait:
  - `Admin\Component\HeaderLinks`
- Page Object:
  - `Admin\CoreSetting\PerformanceTab`
- Methods:
  - `Admin\CoreSetting\SettingsTab`
    - `openAdministration()`,
    - `setAdminFormat()`,
    - `save()`
  - `Admin\Product\MainProductPage::save()`
- Property:
  - `Admin\Order\OrderList::$orderBillingLastNameInput`
        
## [v2.1.0] - 2021-07-09

### Added
- Method:
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::seeSearchCount`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::selectProductsPerPage`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::selectListDisplayType`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::openNextListPage`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::openPreviousListPage`
  - `OxidEsales\Codeception\Page\Lists\ProductSearchList::openListPageNumber`

## [v2.0.0] - 2021-03-25

### Added
- Support of codeception v4
- Add usage of codeception retry

## [v1.4.0] - 2020-11-10

### Added
- Admin Product page objects:
    - Selection tab
    - Variants tab
    - Assign selection lists Popup window
- Class:
    - `OxidEsales\Codeception\Admin\CoreSetting\SettingsTab`
    - `OxidEsales\Codeception\Page\Account\MyDownloads`
    - `OxidEsales\Codeception\Admin\Languages`
    - `OxidEsales\Codeception\Admin\Tools`
    - `OxidEsales\Codeception\Admin\CMSPages`
    - `OxidEsales\Codeception\Admin\DataObject\AdminUser`
    - `OxidEsales\Codeception\Admin\DataObject\AdminUserAddresses`
    - `OxidEsales\Codeception\Admin\DataObject\AdminUserExtendedInfo`
    - `OxidEsales\Codeception\Admin\Component\FillForm`
-Trait
    - `OxidEsales\Codeception\Admin\Component\AdminUserForm`
    - `OxidEsales\Codeception\Admin\Component\AdminUserAddressesForm`
    - `OxidEsales\Codeception\Admin\Component\AdminUserExtendedInfoForm`
- Method:
    - `OxidEsales\Codeception\Admin\CoreSettings::openSettingsTab`
    - `OxidEsales\Codeception\Admin\Orders::find`
    - `OxidEsales\Codeception\Admin\Orders::openDownloadsTab`
    - `OxidEsales\Codeception\Admin\Products::openDownloadsTab`
    - `OxidEsales\Codeception\Page\Account\Component\AccountNavigation::openMyDownloadsPage`
    - `OxidEsales\Codeception\Admin\Component\AdminMenu::openLanguages`
    - `OxidEsales\Codeception\Admin\Component\AdminMenu::openTools`
    - `OxidEsales\Codeception\Admin\Component\AdminMenu::openCMSPages`
    - `OxidEsales\Codeception\Admin\Users::createNewUser`
    - `OxidEsales\Codeception\Admin\Users::editUser`
    - `OxidEsales\Codeception\Admin\Users::openExtendedTab`
    - `OxidEsales\Codeception\Admin\Users::openHistoryTab`
    - `OxidEsales\Codeception\Admin\Users::openProductsTab`
    - `OxidEsales\Codeception\Admin\Users::openPaymentTab`
    - `OxidEsales\Codeception\Admin\Users::createNewRemark`
    - `OxidEsales\Codeception\Admin\Users::deleteRemark`
    - `OxidEsales\Codeception\Admin\Users::openAddressesTab`
    - `OxidEsales\Codeception\Admin\Users::createNewAddress`
    - `OxidEsales\Codeception\Admin\Users::deleteSelectedAddress`  
    - `OxidEsales\Codeception\Admin\Users::editExtentedInfo`  

## [v1.3.3] - 2020-07-06

### Added
- Methods:
    - `Page\Account\UserAddress::seeNumberOfShippingAddresses`
### Fixed
- Methods:
    - `Page\Account\UserAddress::deleteShippingAddress`
    - `Page\Component\Modal::confirmDeletion`

## [v1.3.2] - 2020-04-21

### Added
- Properties:
    - `Page\Component\UserForm::$userNameField`
- Methods:
    - `Page\Component\UserForm::modifyUserName`
    - `Step\Basket::addProductToBasketAndOpenUserCheckout`
    - `Step\Basket::addProductToBasketAndOpenBasket`

### Deprecated
- Methods:
    - `Step\Basket::addProductToBasketAndOpen`

## [v1.3.1] - 2020-04-09

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

## [v1.3.0] - 2020-03-12

### Added
- New traits
    - CurrencyMenu

- New methods
    - ProductSearchList::selectSorting

- New properties
    - AccountMenu::userAccount
    - AccountNavigation::accountMenu

## [v1.2.0] - 2020-02-19

### Added
- Admin page objects
    - Orders
    
- New methods
    - ThankYou::grabOrderNumber
    - AdminMenu::openOrders
    - AdminMenu::openProducts

## [v1.1.1] - 2020-02-07

### Fixed
- Variant selection

## [v1.1.0] - 2019-11-07

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

## [v1.0.0] -  2019-07-26

### Added
- First version of the module introduced

[v4.1.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v4.1.0..v4.2.0
[v4.1.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v4.0.1..v4.1.0
[v4.0.1]: https://github.com/OXID-eSales/codeception-page-object/compare/v4.0.0..v4.0.1
[v4.0.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v3.0.0..v4.0.0
[v3.0.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v2.3.0..v3.0.0
[v2.3.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v2.2.0..v2.3.0
[v2.2.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v2.1.0..v2.2.0
[v2.1.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v2.0.0..v2.1.0
[v2.0.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.4.0..v2.0.0
[v1.4.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.3.3..v1.4.0
[v1.3.3]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.3.2..v1.3.3
[v1.3.2]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.3.1..v1.3.2
[v1.3.1]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.3.0..v1.3.1
[v1.3.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.2.0..v1.3.0
[v1.2.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.1.1..v1.2.0
[v1.1.1]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.1.0..v1.1.1
[v1.1.0]: https://github.com/OXID-eSales/codeception-page-object/compare/v1.0.0..v1.1.0
[v1.0.0]: https://github.com/OXID-eSales/codeception-page-object/compare/81ac79e25ab110042e4d4020fe0b42e68a475ad6..v1.0.0
