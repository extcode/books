<?php

declare(strict_types=1);

defined('TYPO3') or die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

call_user_func(function () {
    $_LLL_be = 'LLL:EXT:books/Resources/Private/Language/locallang_be.xlf';

    $pluginNames = [
        'Books' => [
            'additionalNewFields' => 'pages',
            'iconIdentifier' => 'ext-books-wizard-icon',
            'translationKeyPrefix' => $_LLL_be . 'tx_books.plugin.books',
        ],
        'SingleBook' => [
            'iconIdentifier' => 'ext-books-wizard-icon',
            'translationKeyPrefix' => $_LLL_be . 'tx_cartproducts.plugin.single_book',
        ],
        'TeaserBooks' => [
            'iconIdentifier' => 'ext-books-wizard-icon',
            'translationKeyPrefix' => $_LLL_be . 'tx_cartproducts.plugin.teaser_books',
        ],
    ];

    foreach ($pluginNames as $pluginName => $pluginConf) {
        $pluginSignature = ExtensionUtility::registerPlugin(
            'books',
            $pluginName,
            $pluginConf['translationKeyPrefix'] . '.title',
            $pluginConf['iconIdentifier'],
            'plugins',
            $pluginConf['translationKeyPrefix'] . '.description',
        );

        $flexFormPath = 'EXT:books/Configuration/FlexForms/' . $pluginName . 'Plugin.xml';
        if (file_exists(GeneralUtility::getFileAbsFileName($flexFormPath))) {
            ExtensionManagementUtility::addToAllTCAtypes(
                'tt_content',
                rtrim('--div--;Configuration,pi_flexform,' . ($pluginConf['additionalNewFields'] ?? ''), ','),
                $pluginSignature,
                'after:subheader',
            );

            ExtensionManagementUtility::addPiFlexFormValue(
                '*',
                'FILE:' . $flexFormPath,
                $pluginSignature,
            );
        }
    }
});
