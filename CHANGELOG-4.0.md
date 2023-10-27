# Change Log for OXID eShop Codeception Page Objects

## [v4.2.0] - unreleased

### Added
- New methods for Checkout testing
- Page objects:
  - `Page\Component\Widget\ProductCard`
  - `Page\Component\Widget\Promotion`
  - `Page\Info\ContactPage`
  - `ShopSetup`
- Methods:
  - `Page\Component\Footer\ServiceWidget::openContactPage()`
  - `Page\Home::getBargainArticleList`
  - `Page\Home::getNewestArticles`
  - `Page\Home::getPromotionTop5`
  - `Page\Home::getPromotion`
- Traits:
  - `Page\Component\CookieNotice`
  - `Page\Component\MaintenancePage`

### Changed
- New traits added to `Page\Page`

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
  - `Admin\Service\Tools::runSqlUpdate()`
  - `Admin\Service\Tools::seeInSqlOutput()`
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
