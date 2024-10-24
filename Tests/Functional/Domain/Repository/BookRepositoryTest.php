<?php

namespace Extcode\Books\Tests\Functional\Domain\Repository;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Codappix\Typo3PhpDatasets\TestingFramework;
use Extcode\Books\Domain\Model\Book;
use Extcode\Books\Domain\Repository\BookRepository;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Core\SystemEnvironmentBuilder;
use TYPO3\CMS\Core\Http\ServerRequest;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

#[CoversClass(BookRepository::class)]
class BookRepositoryTest extends FunctionalTestCase
{
    use TestingFramework;

    protected BookRepository $bookRepository;

    public function setUp(): void
    {
        $this->testExtensionsToLoad[] = 'extcode/books';

        parent::setUp();

        $GLOBALS['TYPO3_REQUEST'] = (new ServerRequest())
            ->withAttribute('applicationType', SystemEnvironmentBuilder::REQUESTTYPE_BE);

        $this->bookRepository = GeneralUtility::makeInstance(BookRepository::class);

        $this->importPHPDataSet(__DIR__ . '/../../../Fixtures/PagesDatabase.php');
        $this->importPHPDataSet(__DIR__ . '/../../../Fixtures/BooksDatabase.php');
    }

    public function tearDown(): void
    {
        unset($this->bookRepository);
    }

    #[Test]
    public function findRecordsByUid(): void
    {
        $book = $this->bookRepository->findByUid(1);

        self::assertInstanceOf(
            Book::class,
            $book
        );

        self::assertSame(
            'NSA',
            $book->getTitle()
        );
        self::assertSame(
            'Nationales Sicherheits-Amt',
            $book->getSubtitle()
        );
    }

    #[Test]
    public function findAllRecords(): void
    {
        $books = $this->bookRepository->findAll();
        self::assertSame(
            0,
            $books->count()
        );

        $querySettings = $this->bookRepository->createQuery()->getQuerySettings();
        $querySettings->setRespectStoragePage(false);
        $this->bookRepository->setDefaultQuerySettings($querySettings);
        $books = $this->bookRepository->findAll();
        self::assertSame(
            3,
            $books->count()
        );
    }
}
