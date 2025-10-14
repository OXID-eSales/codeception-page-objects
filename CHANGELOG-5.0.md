# Change Log for OXID eShop Codeception Page Objects

## v5.0.0 - 2025-10-14

### Added
- Category details and navigation objects
- New methods and Page objects for
  - Category management
  - Category sorting
  - Category rights
  - Category list handling
  - Username management in admin
  - Order overview statistics in admin
- Page components for:
  - Product assignment popups
  - Product sorting popups
  - Drag and drop functionality

### Changed
- Revamp voucher page objects

### Deprecated
- Public properties of Page Objects, that represent selectors, will be made private in next major versions.
If possible, page elements should be managed via public methods, accessing them directly is discouraged.
- `ProductCategories` methods extracted into `CategoryListTrait`
- Page objects used for testing browser-based shop setup
- `find()` methods in `ManufacturerList` and `OrderList`
- Method `seeManufacturerIcon` in `PictureManufacturerPage`

### Fixed
- Stability issues in `StartCategoryFrontendPopup`
