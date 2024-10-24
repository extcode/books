<?php

declare(strict_types=1);

defined('TYPO3') or die();

$_LLL_general = 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf';
$_LLL_ttc = 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf';
$_LLL_db = 'LLL:EXT:books/Resources/Private/Language/locallang_db.xlf';
$_LLL_tca = 'LLL:EXT:books/Resources/Private/Language/locallang_tca.xlf';

return [
    'ctrl' => [
        'title' => $_LLL_db . ':tx_books_domain_model_book',
        'label' => 'title',
        'label_alt' => 'author',
        'label_alt_force' => 1,
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',

        'sortby' => 'sorting',

        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'title,teaser,description',
        'iconfile' => 'EXT:books/Resources/Public/Icons/tx_books_domain_model_book.svg',
    ],
    'types' => [
        '1' => [
            'showitem' => '
                --palette--;' . $_LLL_tca . ':tx_books_domain_model_book.palette.title;title,
                path_segment,
                    --palette--;' . $_LLL_tca . ':tx_books_domain_model_book.palette.isbn;isbn,
                --div--;' . $_LLL_tca . ':tx_books_domain_model_book.div.data,
                    --palette--;' . $_LLL_tca . ':tx_books_domain_model_book.palette.author_and_publisher;author_and_publisher,
                    number_of_pages, date_of_publication,
                --div--;' . $_LLL_tca . ':tx_books_domain_model_book.div.descriptions,
                    genre,
                    teaser,
                    description,
                    meta_description,
                --div--;' . $_LLL_tca . ':tx_books_domain_model_book.div.images_and_files,
                    images, files,
                --div--;' . $_LLL_tca . ':tx_books_domain_model_book.div.categorization,
                    category, categories,
                --div--;' . $_LLL_tca . ':tx_books_domain_model_book.div.related_books,
                    related_books,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.tabs.access,
                    --palette--;' . $_LLL_tca . ':palettes.visibility;hiddenonly,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_tca.xlf:pages.palettes.access;access,
            ',
        ],
    ],
    'palettes' => [
        '1' => [
            'showitem' => '',
        ],
        'isbn' => [
            'showitem' => 'isbn10, --linebreak--, isbn13, --linebreak--, issn',
            'canNotCollapse' => 1,
        ],
        'title' => [
            'showitem' => 'title, --linebreak--, subtitle',
            'canNotCollapse' => 1,
        ],
        'author_and_publisher' => [
            'showitem' => 'author, --linebreak--, illustrator, --linebreak--, editor, --linebreak--, publisher, --linebreak--, translator, language',
            'canNotCollapse' => 1,
        ],
        'hiddenonly' => [
            'showitem' => 'hidden;' . $_LLL_db . ':tx_books_domain_model_book',
        ],
        'access' => [
            'showitem' => 'starttime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:starttime_formlabel, endtime;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:endtime_formlabel',
        ],
    ],
    'columns' => [
        'sys_language_uid' => [
            'exclude' => 1,
            'label' => $_LLL_general . ':LGL.language',
            'config' => ['type' => 'language'],
        ],
        'l10n_parent' => [
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => $_LLL_general . ':LGL.l18n_parent',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['label' => '', 'value' => 0],
                ],
                'foreign_table' => 'tx_books_domain_model_book',
                'foreign_table_where' => 'AND tx_books_domain_model_book.pid=###CURRENT_PID### AND tx_books_domain_model_book.sys_language_uid IN (-1,0)',
                'default' => 0,
            ],
        ],
        'l10n_diffsource' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        't3ver_label' => [
            'label' => $_LLL_general . ':LGL.versionLabel',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'max' => 255,
            ],
        ],
        'hidden' => [
            'exclude' => 1,
            'label' => $_LLL_general . ':LGL.hidden',
            'config' => [
                'type' => 'check',
                'items' => [
                    '1' => [
                        'label' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:hidden.I.0',
                    ],
                ],
            ],
        ],
        'starttime' => [
            'exclude' => 1,
            'label' => $_LLL_general . ':LGL.starttime',
            'config' => [
                'type' => 'datetime',
                'size' => 13,
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, (int)date('m'), (int)date('d'), (int)date('Y')),
                ],
            ],
        ],
        'endtime' => [
            'exclude' => 1,
            'label' => 'LLL' . ':EXT:lang/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'datetime',
                'size' => 13,
                'checkbox' => 0,
                'default' => 0,
                'range' => [
                    'lower' => mktime(0, 0, 0, (int)date('m'), (int)date('d'), (int)date('Y')),
                ],
            ],
        ],

        'title' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'required' => true,
            ],
        ],
        'subtitle' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.subtitle',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],

        'path_segment' => [
            'exclude' => true,
            'label' => $_LLL_db . 'tx_books_domain_model_book.path_segment',
            'config' => [
                'type' => 'slug',
                'size' => 50,
                'generatorOptions' => [
                    'fields' => ['title'],
                    'replacements' => [
                        '/' => '',
                    ],
                ],
                'fallbackCharacter' => '-',
                'eval' => 'uniqueInSite',
                'default' => '',
            ],
        ],

        'author' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.author',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'illustrator' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.illustrator',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'editor' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.editor',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'publisher' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.publisher',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'translator' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.translator',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'number_of_pages' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.number_of_pages',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'language' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.language',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'date_of_publication' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.date_of_publication',
            'config' => [
                'type' => 'datetime',
                'size' => 13,
                'checkbox' => 0,
                'default' => 0,
            ],
        ],

        'isbn10' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.isbn10',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'isbn13' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.isbn13',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'issn' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.issn',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],

        'genre' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.genre',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
            ],
        ],
        'teaser' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.teaser',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'eval' => 'trim',
            ],
        ],
        'description' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.description',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
            ],
        ],
        'meta_description' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.meta_description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 5,
                'eval' => 'trim',
            ],
        ],

        'images' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.images',
            'config' => [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => $_LLL_ttc . ':images.addFileReference',
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'allowed' => 'common-image-types',
            ],
        ],

        'files' => [
            'exclude' => 1,
            'label' => $_LLL_db . ':tx_books_domain_model_book.files',
            'config' => [
                'type' => 'file',
                'appearance' => [
                    'createNewRelationLinkTitle' => $_LLL_ttc . ':images.addFileReference',
                    'showPossibleLocalizationRecords' => true,
                    'showRemovedLocalizationRecords' => true,
                    'showAllLocalizationLink' => true,
                    'showSynchronizationLink' => true,
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true,
                ],
                'allowed' => 'common-media-types',
            ],
        ],

        'related_books' => [
            'exclude' => 1,
            'label' => $_LLL_db . 'tx_books_domain_model_book.related_books',
            'config' => [
                'type' => 'group',
                'allowed' => 'tx_books_domain_model_book',
                'foreign_table' => 'tx_books_domain_model_book',
                'MM_opposite_field' => 'related_books_from',
                'size' => 5,
                'minitems' => 0,
                'maxitems' => 100,
                'MM' => 'tx_books_domain_model_book_related_mm',
                'suggestOptions' => [
                    'default' => [
                        'searchWholePhrase' => true,
                    ],
                ],
            ],
        ],

        'related_books_from' => [
            'exclude' => 1,
            'label' => $_LLL_db . 'tx_books_domain_model_book.related_books_from',
            'config' => [
                'type' => 'group',
                'foreign_table' => 'tx_books_domain_model_book',
                'allowed' => 'tx_books_domain_model_book',
                'size' => 5,
                'maxitems' => 100,
                'MM' => 'tx_books_domain_model_book_related_mm',
                'readOnly' => 1,
            ],
        ],

        'category' => [
            'config' => [
                'type' => 'category',
                'relationship' => 'oneToOne',
            ],
        ],

        'categories' => [
            'config' => [
                'type' => 'category',
            ],
        ],
    ],
];
