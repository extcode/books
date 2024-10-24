<?php

declare(strict_types=1);

namespace Extcode\Books\Domain\Model;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

interface BookInterface
{
    public function getTitle(): string;

    public function getTeaser(): string;

    public function getDescription(): string;

    public function getSubtitle(): string;

    public function getIsbn10(): string;

    public function getIsbn13(): string;

    public function getIssn(): string;

    public function getAuthor(): string;

    public function getIllustrator(): string;

    public function getEditor(): string;

    public function getPublisher(): string;

    public function getTranslator(): string;

    public function getLanguage(): string;

    public function getNumberOfPages(): string;

    public function getDateOfPublication(): \DateTime;

    public function getGenre(): string;

    public function getCategory(): ?Category;

    public function getCategories(): ObjectStorage;

    public function getFiles(): ObjectStorage;

    public function getImages(): ObjectStorage;

    public function getFirstImage(): ?FileReference;

    public function getRelatedBooks(): ObjectStorage;

    public function getRelatedBooksFrom(): ObjectStorage;

    public function getMetaDescription(): string;

    public function setMetaDescription(string $metaDescription): void;
}
