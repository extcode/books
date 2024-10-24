<?php

declare(strict_types=1);

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

defined('TYPO3') or die();

$_LLL_db = 'LLL:EXT:books/Resources/Private/Language/locallang_db.xlf';

$newSysCategoryColumns = [
    'book_list_pid' => [
        'exclude' => 1,
        'label' => $_LLL_db . ':tx_books_domain_model_category.book_list_pid',
        'config' => [
            'type' => 'group',
            'allowed' => 'pages',
            'size' => 1,
            'maxitems' => 1,
            'minitems' => 0,
            'default' => 0,
            'suggestOptions' => [
                'default' => [
                    'searchWholePhrase' => true,
                ],
            ],
        ],
    ],
    'book_show_pid' => [
        'exclude' => 1,
        'label' => $_LLL_db . ':tx_books_domain_model_category.book_show_pid',
        'config' => [
            'type' => 'group',
            'allowed' => 'pages',
            'size' => 1,
            'maxitems' => 1,
            'minitems' => 0,
            'default' => 0,
            'suggestOptions' => [
                'default' => [
                    'searchWholePhrase' => true,
                ],
            ],
        ],
    ],
];

ExtensionManagementUtility::addTCAcolumns('sys_category', $newSysCategoryColumns);
ExtensionManagementUtility::addToAllTCAtypes(
    'sys_category',
    'book_list_pid, book_show_pid',
    '',
    'after:description'
);
