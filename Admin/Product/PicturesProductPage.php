<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Page\Page;

use function sprintf;

class PicturesProductPage extends Page
{
    use ProductList;

    private string $uploadInput = '#product-media-uploads-file-input';
    private string $uploadGrid = '.uploads .grid';
    private string $uploadImageCard = '%s .item:nth-of-type(%d)';
    private string $uploadImg = '%s img';
    private string $uploadedImgOverlay = '%s .overlay';
    private string $uploadedImgThumbButton = '%s .set-thumb';
    private string $uploadedImgIconButton = '%s .set-icon';
    private string $uploadedImgActivateButton = '%s .toggle-active';
    private string $uploadedImgDeleteButton = '%s .delete-media';
    private string $thumbnailCard = '.featured-images #thumb';
    private string $iconCard = '.featured-images #icon';
    private string $pageLoaderAnimation = '#loader-animation';
    private string $errorMessagesContainer = '.uploads .error-message';

    public function uploadFile(string $filePath): static
    {
        $I = $this->user;
        $I->attachFile($this->uploadInput, $filePath);
        $this->waitForTabReload();

        return $this;
    }

    public function seeUploadedImage(int $position): static
    {
        $I = $this->user;
        $I->seeImage(
            sprintf(
                $this->uploadImg,
                $this->getUploadedImageCardSelector($position)
            )
        );

        return $this;
    }

    public function dontSeeUploadedImage(int $position): static
    {
        $I = $this->user;
        $I->dontSeeElement(
            sprintf(
                $this->uploadImg,
                $this->getUploadedImageCardSelector($position)
            )
        );

        return $this;
    }

    private function getUploadedImageCardSelector(int $position): string
    {
        return sprintf(
            $this->uploadImageCard,
            $this->uploadGrid,
            $position
        );
    }

    public function seeUploadedImageIsActive(int $position): static
    {
        $I = $this->user;
        $I->seeElement(
            sprintf(
                "$this->uploadedImgActivateButton.active",
                $this->getUploadedImageCardSelector($position)
            )
        );

        return $this;
    }

    public function seeUploadedImageIsInactive(int $position): static
    {
        $I = $this->user;
        $I->seeElement(
            sprintf(
                "$this->uploadedImgActivateButton.inactive",
                $this->getUploadedImageCardSelector($position)
            )
        );

        return $this;
    }

    public function seeUploadedImageIsThumbnail(int $position): static
    {
        $I = $this->user;
        $I->seeElement(
            sprintf(
                "$this->uploadedImgThumbButton.is-thumb",
                $this->getUploadedImageCardSelector($position)
            )
        );
        $I->assertEquals(
            $this->getUploadedImageUrl($position),
            $this->getThumbnailUrl()
        );

        return $this;
    }

    public function seeUploadedImageIsNotThumbnail(int $position): static
    {
        $I = $this->user;
        $I->seeElement(
            sprintf(
                "$this->uploadedImgThumbButton:not(.is-thumb)",
                $this->getUploadedImageCardSelector($position)
            )
        );
        if (!$this->isEmptyThumbnailPlaceholder()) {
            $I->assertNotEquals(
                $this->getUploadedImageUrl($position),
                $this->getThumbnailUrl()
            );
        }

        return $this;
    }

    public function seeUploadedImageIsIcon(int $position): static
    {
        $I = $this->user;
        $I->seeElement(
            sprintf(
                "$this->uploadedImgIconButton.is-icon",
                $this->getUploadedImageCardSelector($position)
            )
        );
        $I->assertEquals(
            $this->getUploadedImageUrl($position),
            $this->getIconUrl()
        );

        return $this;
    }

    public function seeUploadedImageIsNotIcon(int $position): static
    {
        $I = $this->user;
        $I->seeElement(
            sprintf(
                "$this->uploadedImgIconButton:not(.is-icon)",
                $this->getUploadedImageCardSelector($position)
            )
        );
        if (!$this->isEmptyIconPlaceholder()) {
            $I->assertNotEquals(
                $this->getUploadedImageUrl($position),
                $this->getIconUrl()
            );
        }

        return $this;
    }

    public function getUploadedImageUrl(int $position): string
    {
        $I = $this->user;
        $imageAtPosition = sprintf(
            $this->uploadImg,
            $this->getUploadedImageCardSelector($position)
        );

        return $I->grabAttributeFrom($imageAtPosition, 'src');
    }

    public function getLightboxImageUrl(): string
    {
        $I = $this->user;

        return $I->grabAttributeFrom('#lightbox img', 'src');
    }

    public function canSeeUploadedImageInLightbox(int $position): static
    {
        $I = $this->user;
        $I->clickAndWait(sprintf(
            "$this->uploadedImgOverlay",
            $this->getUploadedImageCardSelector($position)
        ));
        $I->waitForElementVisible('#lightbox img');
        $I->assertEquals(
            $this->getUploadedImageUrl($position),
            $this->getLightboxImageUrl()
        );
        $this->closeLightbox();

        return $this;
    }

    public function canSeeThumbnailInLightbox(): static
    {
        $I = $this->user;
        $I->clickAndWait("#thumb .card");
        $I->waitForElementVisible('#lightbox img');
        $I->assertEquals(
            $this->getThumbnailUrl(),
            $this->getLightboxImageUrl()
        );
        $this->closeLightbox();

        return $this;
    }

    public function canSeeIconInLightbox(): static
    {
        $I = $this->user;
        $I->clickAndWait("#icon .card");
        $I->waitForElementVisible('#lightbox img');
        $I->assertEquals(
            $this->getIconUrl(),
            $this->getLightboxImageUrl()
        );
        $this->closeLightbox();

        return $this;
    }

    public function closeLightbox(): static
    {
        $I = $this->user;
        $I->executeJS("document.querySelector('#lightbox').click();");
        $I->waitForElementNotVisible('#lightbox');

        return $this;
    }

    public function setUploadedImageAsThumb(int $position): static
    {
        $I = $this->user;
        $I->clickAndWait(
            sprintf(
                "$this->uploadedImgThumbButton",
                $this->getUploadedImageCardSelector($position)
            )
        );
        $this->waitForTabReload();

        return $this;
    }

    public function setUploadedImageAsIcon(int $position): static
    {
        $I = $this->user;
        $I->clickAndWait(sprintf(
            "$this->uploadedImgIconButton",
            $this->getUploadedImageCardSelector($position)
        ));
        $this->waitForTabReload();

        return $this;
    }

    public function activateUploadedImage(int $position): static
    {
        $I = $this->user;
        $I->clickAndWait(sprintf(
            "$this->uploadedImgActivateButton.inactive",
            $this->getUploadedImageCardSelector($position)
        ));
        $this->waitForTabReload();

        return $this;
    }

    public function deactivateUploadedImage(int $position): static
    {
        $I = $this->user;
        $I->clickAndWait(sprintf(
            "$this->uploadedImgActivateButton.active",
            $this->getUploadedImageCardSelector($position)
        ));
        $this->waitForTabReload();

        return $this;
    }

    public function deleteUploadedImage(int $position): static
    {
        $I = $this->user;
        $I->openAlert(sprintf(
            "$this->uploadedImgDeleteButton",
            $this->getUploadedImageCardSelector($position)
        ));
        $I->acceptPopup();
        $this->waitForTabReload();

        return $this;
    }

    private function isEmptyThumbnailPlaceholder(): bool
    {
        $I = $this->user;

        return empty($I->grabMultiple("$this->thumbnailCard img"));
    }

    private function isEmptyIconPlaceholder(): bool
    {
        $I = $this->user;

        return empty($I->grabMultiple("$this->iconCard img"));
    }

    public function seeEmptyThumbnailPlaceholder(): static
    {
        $I = $this->user;
        $I->dontSeeElement("$this->thumbnailCard img");

        return $this;
    }

    public function seeEmptyIconPlaceholder(): static
    {
        $I = $this->user;
        $I->dontSeeElement("$this->iconCard img");

        return $this;
    }

    public function seeThumbnailImage(): static
    {
        $I = $this->user;
        $I->seeImage("$this->thumbnailCard img");

        return $this;
    }

    public function seeIconImage(): static
    {
        $I = $this->user;
        $I->seeImage("$this->iconCard img");

        return $this;
    }

    public function getThumbnailUrl(): string
    {
        $I = $this->user;

        return $I->grabAttributeFrom("$this->thumbnailCard img", 'src');
    }

    public function getIconUrl(): string
    {
        $I = $this->user;

        return $I->grabAttributeFrom("$this->iconCard img", 'src');
    }

    private function waitForTabReload(): void
    {
        $I = $this->user;
        $I->waitForElementNotVisible($this->pageLoaderAnimation);
        $I->selectEditFrame();
        $I->waitForElementVisible($this->uploadGrid);
    }

    public function seeUploadedImageAtPosition(string $filename, int $position): static
    {
        $I = $this->user;
        $I->assertStringEndsWith(
            $filename,
            $this->getUploadedImageUrl($position)
        );

        return $this;
    }

    /**
     * dragAndDrop() may not work with the current driver version
     * (ChromeDriver is not triggering correct events with jQuery UI sortable)
     */
    public function changeUploadedImagePosition(int $from, int $to): static
    {
        $I = $this->user;
        $source = $this->getUploadedImageCardSelector($from);
        $target = $this->getUploadedImageCardSelector($to);

        $I->dragAndDrop($source, $target);
        $this->waitForTabReload();

        return $this;
    }

    public function seeImageUploadError(string $message): static
    {
        $I = $this->user;
        $I->seeText($message, $this->errorMessagesContainer);

        return $this;
    }
}
