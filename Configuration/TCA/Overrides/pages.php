<?php

declare(strict_types=1);

defined('TYPO3') or die();

call_user_func(function () {
    $_LLL_be = 'LLL:EXT:books/Resources/Private/Language/locallang_be.xlf';

    $GLOBALS['TCA']['pages']['columns']['doktype']['config']['items'][] = [
        'label' => $_LLL_be . ':pages.doktype.188',
        'value' => 188,
        'icon' => 'apps-pagetree-page-books-book',
    ];
    $GLOBALS['TCA']['pages']['columns']['module']['config']['items'][] = [
        'label' => $_LLL_be . ':tcarecords-pages-contains.books',
        'value' => 'books',
        'icon' => 'apps-pagetree-folder-books-books',
    ];

    $GLOBALS['TCA']['pages']['ctrl']['typeicon_classes'][188] = 'apps-pagetree-page-books-book';
    $GLOBALS['TCA']['pages']['ctrl']['typeicon_classes']['contains-books'] = 'apps-pagetree-folder-books-books';
});
