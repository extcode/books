<?php

defined('TYPO3') or die();

use Extcode\Books\Controller\BookController;
use Extcode\Books\Hooks\DataHandler;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

$_LLL_be = 'LLL:EXT:books/Resources/Private/Language/locallang_be.xlf:';

// configure plugins

ExtensionUtility::configurePlugin(
    'books',
    'Books',
    [
        BookController::class => 'show, list',
    ],
    [
        BookController::class => '',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
    'books',
    'TeaserBooks',
    [
        BookController::class => 'teaser',
    ],
    [
        BookController::class => '',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

ExtensionUtility::configurePlugin(
    'books',
    'SingleBook',
    [
        BookController::class => 'show',
    ],
    [
        BookController::class => '',
    ],
    ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
);

// clearCachePostProc Hook

$GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['t3lib/class.t3lib_tcemain.php']['clearCachePostProc']['books_clearcache'] =
    DataHandler::class . '->clearCachePostProc';

// register "books:" namespace
$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['books'][]
    = 'Extcode\\Books\\ViewHelpers';

// register listTemplateLayouts
$GLOBALS['TYPO3_CONF_VARS']['EXT']['books']['templateLayouts']['books'][] = [$_LLL_be . 'flexforms_template.templateLayout.books.table', 'table'];
$GLOBALS['TYPO3_CONF_VARS']['EXT']['books']['templateLayouts']['books'][] = [$_LLL_be . 'flexforms_template.templateLayout.books.grid1', 'grid1'];
$GLOBALS['TYPO3_CONF_VARS']['EXT']['books']['templateLayouts']['books'][] = [$_LLL_be . 'flexforms_template.templateLayout.books.grid3', 'grid3'];
$GLOBALS['TYPO3_CONF_VARS']['EXT']['books']['templateLayouts']['teaser_books'][] = [$_LLL_be . 'flexforms_template.templateLayout.books.table', 'table'];
$GLOBALS['TYPO3_CONF_VARS']['EXT']['books']['templateLayouts']['teaser_books'][] = [$_LLL_be . 'flexforms_template.templateLayout.books.grid1', 'grid1'];
$GLOBALS['TYPO3_CONF_VARS']['EXT']['books']['templateLayouts']['teaser_books'][] = [$_LLL_be . 'flexforms_template.templateLayout.books.grid3', 'grid3'];
