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
            'iconIdentifier' => 'ext-books-wizard-icon',
            'showitem' => 'pi_flexform, pages',
        ],
        'SingleBook' => [
            'iconIdentifier' => 'ext-books-wizard-icon',
            'showitem' => 'pi_flexform',
        ],
        'TeaserBooks' => [
            'iconIdentifier' => 'ext-books-wizard-icon',
            'showitem' => 'pi_flexform',
        ],
    ];

    foreach ($pluginNames as $pluginName => $pluginConfig) {
        $pluginSignature = 'books_' . strtolower($pluginName);
        $pluginNameSC = strtolower((string)preg_replace('/[A-Z]/', '_$0', lcfirst($pluginName)));
        ExtensionUtility::registerPlugin(
            'Books',
            $pluginName,
            $_LLL_be . ':tx_books.plugin.' . $pluginNameSC . '.title',
            $pluginConfig['iconIdentifier']
        );

        $flexFormPath = 'EXT:books/Configuration/FlexForms/' . $pluginName . 'Plugin.xml';
        if (file_exists(GeneralUtility::getFileAbsFileName($flexFormPath))) {
            $GLOBALS['TCA']['tt_content']['types'][$pluginSignature]['showitem'] = $pluginConfig['showitem'];

            ExtensionManagementUtility::addPiFlexFormValue(
                '*',
                'FILE:' . $flexFormPath,
                $pluginSignature
            );
        }
    }
});
