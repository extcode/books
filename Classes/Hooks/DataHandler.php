<?php

declare(strict_types=1);

namespace Extcode\Books\Hooks;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use TYPO3\CMS\Core\Cache\CacheManager;

/**
 * Hook into tcemain which is used to show preview of books item
 */
#[Autoconfigure(public: true)]
class DataHandler
{
    public function __construct(
        private readonly CacheManager $cacheManager,
    ) {
    }

    /**
     * Flushes the cache if a news record was edited.
     * This happens on two levels: by UID and by PID.
     */
    public function clearCachePostProc(array $params): void
    {
        if (isset($params['table']) && ($params['table'] === 'tx_books_domain_model_book')) {
            $cacheTagsToFlush = [];
            if (isset($params['uid'])) {
                $cacheTagsToFlush[] = 'tx_books_book_' . $params['uid'];
            }
            if (isset($params['uid_page'])) {
                $cacheTagsToFlush[] = 'tx_books_book_' . $params['uid_page'];
            }

            foreach ($cacheTagsToFlush as $cacheTag) {
                $this->cacheManager->flushCachesInGroupByTag('pages', $cacheTag);
            }
        }
    }
}
