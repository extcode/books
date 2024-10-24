<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider;

return [
    'apps-pagetree-folder-books-books' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:books/Resources/Public/Icons/apps_pagetree_folder_books_books.svg',
    ],
    'apps-pagetree-page-books-book' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:books/Resources/Public/Icons/apps_pagetree_page_books_books.svg',
    ],
    'ext-books-wizard-icon' => [
        'provider' => SvgIconProvider::class,
        'source' => 'EXT:books/Resources/Public/Icons/books_plugin_wizard.svg',
    ],
];
