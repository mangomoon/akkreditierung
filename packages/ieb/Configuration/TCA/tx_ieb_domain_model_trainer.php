<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer',
        'label' => 'nachname',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'nachname,vorname,lebenslauf,qualifikation_babi,lehr_befugnis,qualifikation_psa,qualifikation_psa_kommentar,title',
        'iconfile' => 'EXT:ieb/Resources/Public/Icons/tx_ieb_domain_model_trainer.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'nachname, vorname, verwendung_babi, verwendung_psa, lebenslauf, qualifikation_babi, lehr_befugnis, qualifikation_psa1, qualifikation_psa2, qualifikation_psa3, qualifikation_psa4, qualifikation_psa5, qualifikation_psa6, qualifikation_psa7, qualifikation_psa8, qualifikation_psa, qualifikation_psa_kommentar, anerkennung_pp3, title, lebenslauf_datei, qualifikation_babi_datei, lehr_befugnis_datei, qualifikation_psa_datei, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
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
        'starttime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.starttime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],
        'endtime' => [
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.endtime',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'eval' => 'datetime,int',
                'default' => 0,
                'range' => [
                    'upper' => mktime(0, 0, 0, 1, 1, 2038)
                ],
                'behaviour' => [
                    'allowLanguageSynchronization' => true
                ]
            ],
        ],

        'nachname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.nachname',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'vorname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.vorname',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'verwendung_babi' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.verwendung_babi',
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
        'verwendung_psa' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.verwendung_psa',
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
        'lebenslauf' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.lebenslauf',
            'config' => [
                'type' => 'text',
                'enableRichtext' => true,
                'richtextConfiguration' => 'default',
                'fieldControl' => [
                    'fullScreenRichtext' => [
                        'disabled' => false,
                    ],
                ],
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
            ],
            
        ],
        'qualifikation_babi' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_babi',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'lehr_befugnis' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.lehr_befugnis',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'qualifikation_psa1' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa1',
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
        'qualifikation_psa2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa2',
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
        'qualifikation_psa3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa3',
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
        'qualifikation_psa4' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa4',
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
        'qualifikation_psa5' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa5',
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
        'qualifikation_psa6' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa6',
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
        'qualifikation_psa7' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa7',
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
        'qualifikation_psa8' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa8',
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
        'qualifikation_psa' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'qualifikation_psa_kommentar' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa_kommentar',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'anerkennung_pp3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.anerkennung_pp3',
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
        'title' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.title',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'lebenslauf_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.lebenslauf_datei',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'lebenslauf_datei',
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
                        'fieldname' => 'lebenslauf_datei',
                        'tablenames' => 'tx_ieb_domain_model_trainer',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'qualifikation_babi_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_babi_datei',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'qualifikation_babi_datei',
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
                        'fieldname' => 'qualifikation_babi_datei',
                        'tablenames' => 'tx_ieb_domain_model_trainer',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'lehr_befugnis_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.lehr_befugnis_datei',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'lehr_befugnis_datei',
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
                        'fieldname' => 'lehr_befugnis_datei',
                        'tablenames' => 'tx_ieb_domain_model_trainer',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'qualifikation_psa_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_trainer.qualifikation_psa_datei',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'qualifikation_psa_datei',
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
                        'fieldname' => 'qualifikation_psa_datei',
                        'tablenames' => 'tx_ieb_domain_model_trainer',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
    
    ],
];
