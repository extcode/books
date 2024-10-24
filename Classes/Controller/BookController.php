<?php

declare(strict_types=1);

namespace Extcode\Books\Controller;

/*
 * This file is part of the package extcode/books.
 *
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 */

use Extcode\Books\Domain\Model\Dto\BookDemand;
use Extcode\Books\Domain\Repository\BookRepository;
use Extcode\Books\Domain\Repository\CategoryRepository;
use Psr\Http\Message\ResponseInterface;
use TYPO3\CMS\Core\Pagination\SimplePagination;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Annotation\IgnoreValidation;
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Extbase\Http\ForwardResponse;
use TYPO3\CMS\Extbase\Pagination\QueryResultPaginator;

class BookController extends ActionController
{
    public function __construct(
        protected readonly BookRepository $bookRepository,
        protected readonly CategoryRepository $categoryRepository
    ) {}

    protected function initializeAction(): void
    {
        if (!empty($GLOBALS['TSFE']) && is_object($GLOBALS['TSFE'])) {
            static $cacheTagsSet = false;

            if (!$cacheTagsSet) {
                $GLOBALS['TSFE']->addCacheTags(['tx_books']);
                $cacheTagsSet = true;
            }
        }
    }

    public function listAction(int $currentPage = 1): ResponseInterface
    {
        if (!$this->settings) {
            $this->settings = [];
        }
        $demand = $this->createDemandObjectFromSettings('list');
        $demand->setActionAndClass(__METHOD__, self::class);

        $itemsPerPage = $this->settings['itemsPerPage'] ?? 20;

        $books = $this->bookRepository->findDemanded($demand);
        $arrayPaginator = new QueryResultPaginator(
            $books,
            $currentPage,
            $itemsPerPage
        );
        $pagination = new SimplePagination($arrayPaginator);
        $this->view->assignMultiple(
            [
                'books' => $books,
                'paginator' => $arrayPaginator,
                'pagination' => $pagination,
                'pages' => range(1, $pagination->getLastPageNumber()),
            ]
        );

        $this->addCacheTags($books);

        $this->dispatchModifyViewEvent();

        return $this->htmlResponse();
    }

    public function teaserAction(): ResponseInterface
    {
        $limit = (int)$this->settings['limit'] ?: (int)$this->configurationManager->getConfiguration(
            ConfigurationManagerInterface::CONFIGURATION_TYPE_SETTINGS,
            'Books'
        )['view']['list']['limit'];

        $books = $this->bookRepository->findByUids($limit, $this->settings['bookUids']);

        $this->view->assign('books', $books);

        $this->addCacheTags($books);

        $this->dispatchModifyViewEvent();

        return $this->htmlResponse();
    }

    #[IgnoreValidation(['value' => 'book'])]
    public function showAction(?int $book = null): ResponseInterface
    {
        if ($book === null) {
            return new ForwardResponse('list');
        }

        $book = $this->bookRepository->findByUid($book);
        $this->view->assign('book', $book);

        $this->addCacheTags([$book]);

        $this->dispatchModifyViewEvent();

        return $this->htmlResponse();
    }

    protected function createDemandObjectFromSettings(string $type): BookDemand
    {
        $demand = GeneralUtility::makeInstance(
            BookDemand::class
        );

        if (
            isset($this->settings['view'][$type]) &&
            is_array($this->settings['view'][$type])
        ) {
            // Use default TypoScript settings for plugin configuration
            $limit = (int)$this->settings['view'][$type]['limit'];
            $orderBy = $this->settings['view'][$type]['orderBy'];
            $orderDirection = $this->settings['view'][$type]['orderDirection'];
        }

        if (isset($this->settings['limit']) && (int)$this->settings['limit'] > 0) {
            $limit = (int)$this->settings['limit'];
        }
        if (isset($limit) && $limit > 0) {
            $demand->setLimit($limit);
        }

        if (isset($this->settings['orderBy']) && !empty($this->settings['orderBy'])) {
            $orderBy = $this->settings['orderBy'];
        }
        if (isset($this->settings['orderDirection']) && !empty($this->settings['orderDirection'])) {
            $orderDirection = $this->settings['orderDirection'];
        }
        if (isset($orderBy) && isset($orderDirection)) {
            $demand->setOrder($orderBy . ' ' . $orderDirection);
        }

        $this->addCategoriesToDemandObjectFromSettings($demand);

        return $demand;
    }

    protected function addCategoriesToDemandObjectFromSettings(BookDemand $demand): void
    {
        if ($this->settings['categoriesList']) {
            $selectedCategories = GeneralUtility::intExplode(
                ',',
                $this->settings['categoriesList'],
                true
            );

            $categories = [];

            if ($this->settings['listSubcategories']) {
                foreach ($selectedCategories as $selectedCategory) {
                    $category = $this->categoryRepository->findByUid($selectedCategory);
                    $categories = array_merge(
                        $categories,
                        $this->categoryRepository->findSubcategoriesRecursiveAsArray($category)
                    );
                }
            } else {
                $categories = $selectedCategories;
            }

            $demand->setCategories($categories);
        }
    }
}
