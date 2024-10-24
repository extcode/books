<?php

declare(strict_types=1);

namespace Extcode\Books\Controller;

/*
 * This file is part of the package extcode/cart.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Books\Event\View\ModifyViewEvent;

abstract class ActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    protected function addCacheTags(iterable $books): void
    {
        $cacheTags = [];

        if (!empty($GLOBALS['TSFE']) && is_object($GLOBALS['TSFE'])) {
            foreach ($books as $book) {
                $cacheTags[] = 'tx_books_book_' . $book->getUid();
            }
            if (count($cacheTags) > 0) {
                $GLOBALS['TSFE']->addCacheTags($cacheTags);
            }
        }
    }

    protected function dispatchModifyViewEvent(): void
    {
        $modifyViewEvent = new ModifyViewEvent(
            $this->request,
            $this->settings,
            $this->view
        );

        $this->eventDispatcher->dispatch($modifyViewEvent);
    }
}
