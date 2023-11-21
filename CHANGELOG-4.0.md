# Change Log for OXID eShop Codeception Page Objects

## v4.2.0 - 2023-11-16

### Added
- New methods and Page objects for 
  - Checkout
  - browser-based Shop setup
  - Product Labels
  - Promotion
  - Contact Page.
  - Product List
- Page components for:
  - Cookie consent management
  - Maintenance page detection
  - Access to Payment Summaries on various checkout pages.

### Deprecated
- Parts of `OrderCheckout`'s public interface, extracted into `PaymentSummaryTrait`

## v4.1.0 - 2023-05-09

### Fixed
- Checks for Page objects' availability

### Added
- Page objects for `Manufacturer`, `Import/Export`, list pages and core settign
- New header and footer components to increase flexibility 
- Tons of methods to extend the flexibility and functionality of Account, Checkout, components and admin tools check

### Deprecated
- `Page\Lists\ProductList::openDetailsPage()`

## v4.0.1 - 2022-11-23

### Fixed
- Checks for Page objects' availability

## v4.0.0 - 2022-10-28

### Added
- Compatibility with Codeception v5

### Removed
- `Admin\Component\AdminUserAddressesForm`
- `Admin\Component\AdminUserExtendedInfoForm`
- `Admin\Component\AdminUserForm`
- `Admin\Component\FillForm`
- `Admin\Tools`
