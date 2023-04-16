<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'name,adresse,ort,koop_schule,review_comment_internal,review_comment_tr',
        'iconfile' => 'EXT:ieb/Resources/Public/Icons/tx_ieb_domain_model_staticstandort.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'name, adresse, plz, ort, pruef_bescheid, koop_schule, koop_schule_datei, review_comment_internal, review_comment_tr, review_comment_status, review_frist, based_on, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, '],
    ],
    'columns' => [
        'hidden' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.visible',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                        'invertStateDisplay' => true
                    ]
                ],
            ],
        ],

        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.name',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.name.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'adresse' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.adresse',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.adresse.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'plz' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.plz',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.plz.description',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'ort' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.ort',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.ort.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'pruef_bescheid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.pruef_bescheid',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.pruef_bescheid.description',
            'config' => [
                'type' => 'check',
                'renderType' => 'checkboxToggle',
                'items' => [
                    [
                        0 => '',
                        1 => '',
                    ]
                ],
                'default' => 0,
            ]
        ],
        'koop_schule' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.koop_schule',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.koop_schule.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'koop_schule_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.koop_schule_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.koop_schule_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'koop_schule_datei',
                [
                    'appearance' => [
                        'createNewRelationLinkTitle' => 'LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:media.addFileReference'
                    ],
                    'overrideChildTca' => [
                        'types' => [
                            '0' => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_TEXT => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_IMAGE => [
                                'showitem' => '
                                --palette--;;imageoverlayPalette,
                                --palette--;;filePalette',
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_AUDIO => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_VIDEO => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ],
                            \TYPO3\CMS\Core\Resource\File::FILETYPE_APPLICATION => [
                                'showitem' => '
                                --palette--;LLL:EXT:lang/locallang_tca.xlf:sys_file_reference.imageoverlayPalette;imageoverlayPalette,
                                --palette--;;filePalette'
                            ]
                        ],
                    ],
                    'foreign_match_fields' => [
                        'fieldname' => 'koop_schule_datei',
                        'tablenames' => 'tx_ieb_domain_model_staticstandort',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'review_comment_internal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.review_comment_internal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.review_comment_internal.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_comment_tr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.review_comment_tr',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.review_comment_tr.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_comment_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.review_comment_status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.review_comment_status.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'items' => [
                    ['-- Label --', 0],
                ],
                'size' => 1,
                'maxitems' => 1,
                'eval' => ''
            ],
        ],
        'review_frist' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.review_frist',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.review_frist.description',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 7,
                'eval' => 'date',
                'default' => null,
            ],
        ],
        'based_on' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.based_on',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_staticstandort.based_on.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_ieb_domain_model_standort',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],
            
        ],
    
    ],
];
