<?php

declare(strict_types=1);

defined('TYPO3') or die();
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(function () {
    $_LLL_be = 'LLL:EXT:books/Resources/Private/Language/locallang_be.xlf';

    $pluginNames = [
        'Books' => [
            'additionalNewFields' => 'pages',
            'iconIdentifier' => 'ext-books-wizard-icon',
        ],
        'SingleBook' => [
            'iconIdentifier' => 'ext-books-wizard-icon',
        ],
        'TeaserBooks' => [
            'iconIdentifier' => 'ext-books-wizard-icon',
        ],
    ];

    foreach ($pluginNames as $pluginName => $pluginConfig) {
        $pluginSignature = 'books_' . strtolower($pluginName);

        $flexFormPath = 'EXT:books/Configuration/FlexForms/' . $pluginName . 'Plugin.xml';
        if (file_exists(GeneralUtility::getFileAbsFileName($flexFormPath))) {
            $flexFormPath = 'FILE:' . $flexFormPath;
        } else {
            $flexFormPath = '';
        }

        ExtensionUtility::registerPlugin(
            'Books',
            $pluginName,
            $_LLL_be . ':tx_books.plugin.' . $pluginSignature . '.title',
            $pluginConfig['iconIdentifier'],
            'plugins',
            $_LLL_be . ':tx_books.plugin.' . $pluginSignature . '.description',
            $flexFormPath
        );
    }
});
