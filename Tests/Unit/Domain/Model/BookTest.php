<?php

declare(strict_types=1);

namespace Extcode\Books\Tests\Unit\Domain\Model;

use Extcode\Books\Domain\Model\Book;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\TestingFramework\Core\Unit\UnitTestCase;

#[CoversClass(Book::class)]
class BookTest extends UnitTestCase
{
    protected Book $book;

    protected function setUp(): void
    {
        $this->book = new Book();
    }

    protected function tearDown(): void
    {
        unset($this->book);
    }

    #[Test]
    public function getSubtitleReturnsInitialValueForSubtitle(): void
    {
        self::assertSame(
            '',
            $this->book->getSubtitle()
        );
    }

    #[Test]
    public function setTitleForStringSetsTitle(): void
    {
        $this->setProperty($this->book, 'title', 'Book Title');

        self::assertSame(
            'Book Title',
            $this->book->getTitle()
        );
    }

    #[Test]
    public function setSubtitleForStringSetsSubtitle(): void
    {
        $this->setProperty($this->book, 'subtitle', 'Book Subtitle');

        self::assertSame(
            'Book Subtitle',
            $this->book->getSubtitle()
        );
    }

    #[Test]
    public function getAuthorReturnsInitialValueForAuthor(): void
    {
        self::assertSame(
            '',
            $this->book->getAuthor()
        );
    }

    #[Test]
    public function setAuthorForStringSetsAuthor(): void
    {
        $this->setProperty($this->book, 'author', 'Book Author');

        self::assertSame(
            'Book Author',
            $this->book->getAuthor()
        );
    }

    #[Test]
    public function getIllustratorReturnsInitialValueForIllustrator(): void
    {
        self::assertSame(
            '',
            $this->book->getIllustrator()
        );
    }

    #[Test]
    public function setIllustratorForStringSetsIllustrator(): void
    {
        $this->setProperty($this->book, 'illustrator', 'Book Illustrator');

        self::assertSame(
            'Book Illustrator',
            $this->book->getIllustrator()
        );
    }

    #[Test]
    public function getEditorReturnsInitialValueForEditor(): void
    {
        self::assertSame(
            '',
            $this->book->getEditor()
        );
    }

    #[Test]
    public function setEditorForStringSetsEditor(): void
    {
        $this->setProperty($this->book, 'editor', 'Book Editor');

        self::assertSame(
            'Book Editor',
            $this->book->getEditor()
        );
    }

    #[Test]
    public function getPublisherReturnsInitialValueForPublisher(): void
    {
        self::assertSame(
            '',
            $this->book->getPublisher()
        );
    }

    #[Test]
    public function setPublisherForStringSetsPublisher(): void
    {
        $this->setProperty($this->book, 'publisher', 'Book Publisher');

        self::assertSame(
            'Book Publisher',
            $this->book->getPublisher()
        );
    }

    #[Test]
    public function getTranslatorReturnsInitialValueForTranslator(): void
    {
        self::assertSame(
            '',
            $this->book->getTranslator()
        );
    }

    #[Test]
    public function setTranslatorForStringSetsTranslator(): void
    {
        $this->setProperty($this->book, 'translator', 'Book Translator');

        self::assertSame(
            'Book Translator',
            $this->book->getTranslator()
        );
    }

    #[Test]
    public function getLanguageReturnsInitialValueForLanguage(): void
    {
        self::assertSame(
            '',
            $this->book->getLanguage()
        );
    }

    #[Test]
    public function setLanguageForStringSetsLanguage(): void
    {
        $this->setProperty($this->book, 'language', 'Book Language');

        self::assertSame(
            'Book Language',
            $this->book->getLanguage()
        );
    }

    #[Test]
    public function getNumberOfPagesReturnsInitialValueForNumberOfPages(): void
    {
        self::assertSame(
            '',
            $this->book->getNumberOfPages()
        );
    }

    #[Test]
    public function setNumberOfPagesForStringSetsNumberOfPages(): void
    {
        $this->setProperty($this->book, 'numberOfPages', 'Book NumberOfPages');

        self::assertSame(
            'Book NumberOfPages',
            $this->book->getNumberOfPages()
        );
    }

    #[Test]
    public function getGenreReturnsInitialValueForGenre(): void
    {
        self::assertSame(
            '',
            $this->book->getGenre()
        );
    }

    #[Test]
    public function setGenreForStringSetsGenre(): void
    {
        $this->setProperty($this->book, 'genre', 'Book Genre');

        self::assertSame(
            'Book Genre',
            $this->book->getGenre()
        );
    }

    #[Test]
    public function getIsbn10ReturnsInitialValueForIsbn10(): void
    {
        self::assertSame(
            '',
            $this->book->getIsbn10()
        );
    }

    #[Test]
    public function setIsbn10ForStringSetsIsbn10(): void
    {
        $this->setProperty($this->book, 'isbn10', 'Book Isbn10');

        self::assertSame(
            'Book Isbn10',
            $this->book->getIsbn10()
        );
    }

    #[Test]
    public function getIsbn13ReturnsInitialValueForIsbn13(): void
    {
        self::assertSame(
            '',
            $this->book->getIsbn13()
        );
    }

    #[Test]
    public function setIsbn13ForStringSetsIsbn13(): void
    {
        $this->setProperty($this->book, 'isbn13', 'Book Isbn13');

        self::assertSame(
            'Book Isbn13',
            $this->book->getIsbn13()
        );
    }

    #[Test]
    public function getIssnReturnsInitialValueForIssn(): void
    {
        self::assertSame(
            '',
            $this->book->getIssn()
        );
    }

    #[Test]
    public function setIssnForStringSetsIssn(): void
    {
        $this->setProperty($this->book, 'issn', 'Book Issn');

        self::assertSame(
            'Book Issn',
            $this->book->getIssn()
        );
    }

    private function setProperty(object $instance, string $propertyName, mixed $propertyValue)
    {
        $reflection = new \ReflectionProperty($instance, $propertyName);
        $reflection->setAccessible(true);
        $reflection->setValue($instance, $propertyValue);
    }
}
