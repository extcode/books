<?php

declare(strict_types=1);

namespace Extcode\Books\Tests\Functional\Hooks;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Books\Hooks\DataHandler;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use TYPO3\CMS\Core\Cache\Backend\Typo3DatabaseBackend;
use TYPO3\CMS\Core\Cache\CacheManager;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\TestingFramework\Core\Functional\FunctionalTestCase;

#[CoversClass(DataHandler::class)]
class DataHandlerTest extends FunctionalTestCase
{
    protected array $configurationToUseInTestInstance = [
        'SYS' => [
            'caching' => [
                'cacheConfigurations' => [
                    'pages' => [
                        'backend' => Typo3DatabaseBackend::class,
                    ],
                ],
            ],
        ],
    ];

    protected function setUp(): void
    {
        $this->testExtensionsToLoad[] = 'extcode/books';

        parent::setUp();
    }

    #[Test]
    public function clearCachePostProcFlushesPageCacheEntriesTaggedWithBook(): void
    {
        $pageCache = GeneralUtility::makeInstance(CacheManager::class)->getCache('pages');
        $pageCache->set('book-detail', 'content', ['tx_books_book_1']);
        $pageCache->set('other-page', 'content', ['tx_books_book_2']);

        self::assertTrue($pageCache->has('book-detail'));

        GeneralUtility::makeInstance(DataHandler::class)->clearCachePostProc([
            'table' => 'tx_books_domain_model_book',
            'uid' => 1,
        ]);

        self::assertFalse($pageCache->has('book-detail'));
        self::assertTrue($pageCache->has('other-page'));
    }
}
