<?php

/**
 * Copyright © OXID eSales AG. All rights reserved.
 * See LICENSE file for license details.
 */

declare(strict_types=1);

namespace OxidEsales\Codeception\Admin\Product;

use OxidEsales\Codeception\Page\Page;

use function sprintf;

class PictureAltProductPage extends Page
{
    use ProductList;

    private string $imageRow = '#picture-alt-manager .picture-alt-row[data-row-id="%s"]';
    private string $expandRow = '#picture-alt-manager .expand-row[id="expand-%s"]';
    private string $altTextInput = '%s input[data-locale-code="%s"]';
    private string $languageBadge = '%s .lang-badge[data-locale-code="%s"]';
    private string $languageBadgeWithState = '%s .lang-badge.%s[data-locale-code="%s"]';
    private string $emptyState = '#picture-alt-manager .empty-state';
    private string $saveButton = '%s .save-btn';

    public function seeImage(string $mediaId): static
    {
        $I = $this->user;
        $I->seeElement($this->getImageRowSelector($mediaId));

        return $this;
    }

    public function seeEmptyState(): static
    {
        $I = $this->user;
        $I->seeElement($this->emptyState);

        return $this;
    }

    public function expandImage(string $mediaId): static
    {
        $I = $this->user;
        $I->click($this->getImageRowSelector($mediaId));
        $I->waitForElementVisible($this->getExpandRowSelector($mediaId));

        return $this;
    }

    public function seeExpandedImage(string $mediaId): static
    {
        $I = $this->user;
        $I->seeElement($this->getExpandRowSelector($mediaId));

        return $this;
    }

    public function fillAltText(string $mediaId, string $localeCode, string $text): static
    {
        $I = $this->user;
        $selector = $this->getAltTextInputSelector($mediaId, $localeCode);
        $I->clearField($selector);
        $I->fillField($selector, $text);

        return $this;
    }

    public function seeAltText(string $mediaId, string $localeCode, string $text): static
    {
        $I = $this->user;
        $I->seeInField($this->getAltTextInputSelector($mediaId, $localeCode), $text);

        return $this;
    }

    public function saveAltTexts(string $mediaId): static
    {
        $I = $this->user;
        $I->click(sprintf($this->saveButton, $this->getExpandRowSelector($mediaId)));
        $I->selectEditFrame();

        return $this;
    }

    public function seeLanguageBadgeFilled(string $mediaId, string $localeCode): static
    {
        $I = $this->user;
        $I->seeElement($this->getLanguageBadgeWithStateSelector($mediaId, $localeCode, 'filled'));

        return $this;
    }

    public function seeLanguageBadgeChanged(string $mediaId, string $localeCode): static
    {
        $I = $this->user;
        $I->seeElement($this->getLanguageBadgeWithStateSelector($mediaId, $localeCode, 'changed'));

        return $this;
    }

    public function seeLanguageBadgeEmpty(string $mediaId, string $localeCode): static
    {
        $I = $this->user;
        $I->dontSeeElement($this->getLanguageBadgeWithStateSelector($mediaId, $localeCode, 'filled'));
        $I->dontSeeElement($this->getLanguageBadgeWithStateSelector($mediaId, $localeCode, 'changed'));
        $I->seeElement($this->getLanguageBadgeSelector($mediaId, $localeCode));

        return $this;
    }

    private function getImageRowSelector(string $mediaId): string
    {
        return sprintf($this->imageRow, $mediaId);
    }

    private function getExpandRowSelector(string $mediaId): string
    {
        return sprintf($this->expandRow, $mediaId);
    }

    private function getAltTextInputSelector(string $mediaId, string $localeCode): string
    {
        return sprintf($this->altTextInput, $this->getExpandRowSelector($mediaId), $localeCode);
    }

    private function getLanguageBadgeSelector(string $mediaId, string $localeCode): string
    {
        return sprintf($this->languageBadge, $this->getImageRowSelector($mediaId), $localeCode);
    }

    private function getLanguageBadgeWithStateSelector(string $mediaId, string $localeCode, string $stateClass): string
    {
        return sprintf(
            $this->languageBadgeWithState,
            $this->getImageRowSelector($mediaId),
            $stateClass,
            $localeCode
        );
    }
}
