# Change Log for OXID eShop Codeception Page Objects

## v8.0.0-alpha.3 - Unreleased
*Compilation release*

### Added
- Page objects for language locale management in admin
- Page objects for products alt attribute management in admin

## v8.0.0-alpha.2 - 2026-02-12
*Compilation release*

### Added
- Added methods for managing stock default message settings in admin
- Functionality for Product Pictures management in admin

### Changed
- Assertion method `setRowInDateTable` renamed to `seeRowInDataTable`

## v5.0.0-alpha.1 - 2025-02-03

### Added
- Page objects for stock configuration
- Method in `UserLogin` to confirm that the login form is available
- Admin License tab elements
- Methods to check the output of the System Info page in admin
- Page objects for cache in admin
- Admin interface components: `AssignPopup`, `DataTable`, `EditForm`, `Tabs`
- Methods in `UserHistoryPage` tab

### Removed
- Parts of `OrderCheckout`'s public interface
- Methods of `ProductCategories`
- Page objects used for testing browser-based shop setup
- `find()` methods in `ManufacturerList` and `OrderList`
- Method `seeManufacturerIcon` in `PictureManufacturerPage`

### Changed
- `AdminUserAddresses` data object renamed to `AdminUserAddress`
