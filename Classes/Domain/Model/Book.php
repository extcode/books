<?php

declare(strict_types=1);

namespace Extcode\Books\Domain\Model;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use TYPO3\CMS\Extbase\Annotation\ORM\Lazy;
use TYPO3\CMS\Extbase\Domain\Model\FileReference;
use TYPO3\CMS\Extbase\DomainObject\AbstractEntity;
use TYPO3\CMS\Extbase\Persistence\ObjectStorage;

class Book extends AbstractEntity implements BookInterface
{
    protected string $title = '';

    protected string $teaser = '';

    protected string $description = '';

    protected string $subtitle = '';

    protected string $isbn10 = '';

    protected string $isbn13 = '';

    protected string $issn = '';

    protected string $author = '';

    protected string $illustrator = '';

    protected string $editor = '';

    protected string $publisher = '';

    protected string $translator = '';

    protected string $language = '';

    protected string $numberOfPages = '';

    protected \DateTime $dateOfPublication;

    protected string $genre = '';

    protected ?Category $category = null;

    /**
     * @var ObjectStorage<Category>
     */
    protected ObjectStorage $categories;

    /**
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $files;

    /**
     * @var ObjectStorage<FileReference>
     */
    protected ObjectStorage $images;

    /**
     * @var ObjectStorage<Book>
     */
    #[Lazy]
    protected ObjectStorage $relatedBooks;

    /**
     * @var ObjectStorage<Book>
     */
    #[Lazy]
    protected ObjectStorage $relatedBooksFrom;

    protected string $metaDescription = '';

    public function __construct()
    {
        $this->categories = new ObjectStorage();
        $this->files = new ObjectStorage();
        $this->images = new ObjectStorage();
        $this->relatedBooks = new ObjectStorage();
        $this->relatedBooksFrom = new ObjectStorage();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getTeaser(): string
    {
        return $this->teaser;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSubtitle(): string
    {
        return $this->subtitle;
    }

    public function getIsbn10(): string
    {
        return $this->isbn10;
    }

    public function getIsbn13(): string
    {
        return $this->isbn13;
    }

    public function getIssn(): string
    {
        return $this->issn;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function getIllustrator(): string
    {
        return $this->illustrator;
    }

    public function getEditor(): string
    {
        return $this->editor;
    }

    public function getPublisher(): string
    {
        return $this->publisher;
    }

    public function getTranslator(): string
    {
        return $this->translator;
    }

    public function getLanguage(): string
    {
        return $this->language;
    }

    public function getNumberOfPages(): string
    {
        return $this->numberOfPages;
    }

    public function getDateOfPublication(): \DateTime
    {
        return $this->dateOfPublication;
    }

    public function getGenre(): string
    {
        return $this->genre;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function getCategories(): ObjectStorage
    {
        return $this->categories;
    }

    public function getFiles(): ObjectStorage
    {
        return $this->files;
    }

    public function getImages(): ObjectStorage
    {
        return $this->images;
    }

    public function getFirstImage(): ?FileReference
    {
        $images = $this->getImages()->toArray();
        return array_shift($images);
    }

    public function getRelatedBooks(): ObjectStorage
    {
        return $this->relatedBooks;
    }

    public function getRelatedBooksFrom(): ObjectStorage
    {
        return $this->relatedBooksFrom;
    }

    public function getMetaDescription(): string
    {
        return $this->metaDescription;
    }

    public function setMetaDescription(string $metaDescription): void
    {
        $this->metaDescription = $metaDescription;
    }

}
