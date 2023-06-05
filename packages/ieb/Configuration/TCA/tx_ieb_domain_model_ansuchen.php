<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'searchFields' => 'name,nummer,zuteilung_datum,kompetenzbereiche_text,uebersicht_text,zielgruppen_ansprache,didaktik_kommentar,beratung_text,review_b1_comment_internal,review_b1_comment_tr,review_b2_comment_internal,review_b2_comment_tr,review_c1_comment_internal,review_c1_comment_tr,review_c2_comment_internal,review_c2_comment_tr,review_c3_comment_internal,review_c3_comment_tr,review_total_comment_internal,review_total_comment_tr,pruefbescheid,kooperation,kompetenz_text1,kompetenz_text2,nummerpp3,copy_stammdaten,copy_trainer,copy_berater,copy_standorte',
        'iconfile' => 'EXT:ieb/Resources/Public/Icons/tx_ieb_domain_model_ansuchen.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'name, version, version_based_on, version_active, nummer, akkreditierung_datum, einreich_datum, zuteilung_datum, akkreditierung_entscheidung_datum, typ, bundesland, kompetenzbereiche, kompetenzbereiche_text, uebersicht_text, uebersicht_datei, zielgruppen_ansprache, zielgruppen_ansprache_datei, fernlehre, kinderbetreuung, lernziele, lernstandserhebung, diversity, didaktik_kommentar, beratung_text, beratung_datei, review_b1_comment_internal, review_b1_comment_tr, review_b1_status, review_b2_comment_internal, review_b2_comment_tr, review_b2_status, review_c1_comment_internal, review_c1_comment_tr, review_c1_status, review_c2_comment_internal, review_c2_comment_tr, review_c2_status, review_c3_comment_internal, review_c3_comment_tr, review_c3_status, review_total_comment_internal, review_total_comment_tr, review_total_status, review_total_frist, locked_by, status, ok, pruefbescheid_datei, pruefbescheid, kooperation_datei, kooperation, standort_erklaerung, kompetenz1, kompetenz2, kompetenz3, kompetenz4, kompetenz5, kompetenz6, kompetenz7, kompetenz8, kompetenz9, erklaerungd1, erklaerungd2, erklaerungd3, erklaerungd4, kompetenz_text1, kompetenz_text2, erklaerung_teil_a, erklaerung_teil_b, nummerpp3, erklaerungd5, copy_stammdaten, copy_trainer, copy_berater, copy_standorte, stammdaten_static, standorte_static, verantwortliche, verantwortliche_mail, trainer_static, berater_static, kopie_von, stammdaten, standorte, trainer, berater, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, '],
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
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.name',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.name.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'version' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.version',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.version.description',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'version_based_on' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.version_based_on',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.version_based_on.description',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'version_active' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.version_active',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.version_active.description',
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
        'nummer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.nummer',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.nummer.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'akkreditierung_datum' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.akkreditierung_datum',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.akkreditierung_datum.description',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'einreich_datum' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.einreich_datum',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.einreich_datum.description',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'zuteilung_datum' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.zuteilung_datum',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.zuteilung_datum.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'akkreditierung_entscheidung_datum' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.akkreditierung_entscheidung_datum',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.akkreditierung_entscheidung_datum.description',
            'config' => [
                'dbType' => 'datetime',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 12,
                'eval' => 'datetime',
                'default' => null,
            ],
        ],
        'typ' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.typ',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.typ.description',
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
        'bundesland' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.bundesland',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.bundesland.description',
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
        'kompetenzbereiche' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenzbereiche',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenzbereiche.description',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'kompetenzbereiche_text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenzbereiche_text',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenzbereiche_text.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'uebersicht_text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.uebersicht_text',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.uebersicht_text.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'uebersicht_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.uebersicht_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.uebersicht_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'uebersicht_datei',
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
                        'fieldname' => 'uebersicht_datei',
                        'tablenames' => 'tx_ieb_domain_model_ansuchen',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'zielgruppen_ansprache' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.zielgruppen_ansprache',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.zielgruppen_ansprache.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'zielgruppen_ansprache_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.zielgruppen_ansprache_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.zielgruppen_ansprache_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'zielgruppen_ansprache_datei',
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
                        'fieldname' => 'zielgruppen_ansprache_datei',
                        'tablenames' => 'tx_ieb_domain_model_ansuchen',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'fernlehre' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.fernlehre',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.fernlehre.description',
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
        'kinderbetreuung' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kinderbetreuung',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kinderbetreuung.description',
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
        'lernziele' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.lernziele',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.lernziele.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'lernziele',
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
                        'fieldname' => 'lernziele',
                        'tablenames' => 'tx_ieb_domain_model_ansuchen',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'lernstandserhebung' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.lernstandserhebung',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.lernstandserhebung.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'lernstandserhebung',
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
                        'fieldname' => 'lernstandserhebung',
                        'tablenames' => 'tx_ieb_domain_model_ansuchen',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'diversity' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.diversity',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.diversity.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'diversity',
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
                        'fieldname' => 'diversity',
                        'tablenames' => 'tx_ieb_domain_model_ansuchen',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'didaktik_kommentar' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.didaktik_kommentar',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.didaktik_kommentar.description',
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
        'beratung_text' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.beratung_text',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.beratung_text.description',
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
        'beratung_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.beratung_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.beratung_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'beratung_datei',
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
                        'fieldname' => 'beratung_datei',
                        'tablenames' => 'tx_ieb_domain_model_ansuchen',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'review_b1_comment_internal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b1_comment_internal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b1_comment_internal.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_b1_comment_tr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b1_comment_tr',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b1_comment_tr.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_b1_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b1_status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b1_status.description',
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
        'review_b2_comment_internal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b2_comment_internal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b2_comment_internal.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_b2_comment_tr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b2_comment_tr',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b2_comment_tr.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_b2_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b2_status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_b2_status.description',
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
        'review_c1_comment_internal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c1_comment_internal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c1_comment_internal.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_c1_comment_tr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c1_comment_tr',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c1_comment_tr.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_c1_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c1_status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c1_status.description',
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
        'review_c2_comment_internal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c2_comment_internal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c2_comment_internal.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_c2_comment_tr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c2_comment_tr',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c2_comment_tr.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_c2_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c2_status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c2_status.description',
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
        'review_c3_comment_internal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c3_comment_internal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c3_comment_internal.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_c3_comment_tr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c3_comment_tr',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c3_comment_tr.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_c3_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c3_status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_c3_status.description',
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
        'review_total_comment_internal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_total_comment_internal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_total_comment_internal.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_total_comment_tr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_total_comment_tr',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_total_comment_tr.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_total_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_total_status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_total_status.description',
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
        'review_total_frist' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_total_frist',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.review_total_frist.description',
            'config' => [
                'dbType' => 'date',
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 7,
                'eval' => 'date',
                'default' => null,
            ],
        ],
        'locked_by' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.locked_by',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.locked_by.description',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.status.description',
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
        'ok' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.ok',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.ok.description',
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
        'pruefbescheid_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.pruefbescheid_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.pruefbescheid_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'pruefbescheid_datei',
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
                        'fieldname' => 'pruefbescheid_datei',
                        'tablenames' => 'tx_ieb_domain_model_ansuchen',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'pruefbescheid' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.pruefbescheid',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.pruefbescheid.description',
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
        'kooperation_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kooperation_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kooperation_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'kooperation_datei',
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
                        'fieldname' => 'kooperation_datei',
                        'tablenames' => 'tx_ieb_domain_model_ansuchen',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'kooperation' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kooperation',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kooperation.description',
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
        'standort_erklaerung' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.standort_erklaerung',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.standort_erklaerung.description',
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
        'kompetenz1' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz1',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz1.description',
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
        'kompetenz2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz2',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz2.description',
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
        'kompetenz3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz3',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz3.description',
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
        'kompetenz4' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz4',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz4.description',
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
        'kompetenz5' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz5',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz5.description',
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
        'kompetenz6' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz6',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz6.description',
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
        'kompetenz7' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz7',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz7.description',
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
        'kompetenz8' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz8',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz8.description',
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
        'kompetenz9' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz9',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz9.description',
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
        'erklaerungd1' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd1',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd1.description',
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
        'erklaerungd2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd2',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd2.description',
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
        'erklaerungd3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd3',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd3.description',
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
        'erklaerungd4' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd4',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd4.description',
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
        'kompetenz_text1' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz_text1',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz_text1.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'kompetenz_text2' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz_text2',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kompetenz_text2.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'erklaerung_teil_a' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerung_teil_a',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerung_teil_a.description',
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
        'erklaerung_teil_b' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerung_teil_b',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerung_teil_b.description',
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
        'nummerpp3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.nummerpp3',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.nummerpp3.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'erklaerungd5' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd5',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.erklaerungd5.description',
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
        'copy_stammdaten' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.copy_stammdaten',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.copy_stammdaten.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'copy_trainer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.copy_trainer',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.copy_trainer.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'copy_berater' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.copy_berater',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.copy_berater.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'copy_standorte' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.copy_standorte',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.copy_standorte.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'stammdaten_static' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.stammdaten_static',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.stammdaten_static.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectSingle',
                'foreign_table' => 'tx_ieb_domain_model_staticstammdaten',
                'default' => 0,
                'minitems' => 0,
                'maxitems' => 1,
            ],
            
        ],
        'standorte_static' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.standorte_static',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.standorte_static.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_staticstandort',
                'MM' => 'tx_ieb_ansuchen_staticstandort_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'verantwortliche' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.verantwortliche',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.verantwortliche.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_angebotverantwortlich',
                'MM' => 'tx_ieb_ansuchen_angebotverantwortlich_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'verantwortliche_mail' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.verantwortliche_mail',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.verantwortliche_mail.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_angebotverantwortlich',
                'MM' => 'tx_ieb_ansuchen_verantwortlichemail_angebotverantwortlich_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'trainer_static' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.trainer_static',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.trainer_static.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_statictrainer',
                'MM' => 'tx_ieb_ansuchen_statictrainer_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'berater_static' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.berater_static',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.berater_static.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_staticberater',
                'MM' => 'tx_ieb_ansuchen_staticberater_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'kopie_von' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kopie_von',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.kopie_von.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_ansuchen',
                'default' => 0,
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 1,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'stammdaten' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.stammdaten',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.stammdaten.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_stammdaten',
                'default' => 0,
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 1,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'standorte' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.standorte',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.standorte.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_standort',
                'MM' => 'tx_ieb_ansuchen_standort_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'trainer' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.trainer',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.trainer.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_trainer',
                'MM' => 'tx_ieb_ansuchen_trainer_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
        'berater' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.berater',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_ansuchen.berater.description',
            'config' => [
                'type' => 'select',
                'renderType' => 'selectMultipleSideBySide',
                'foreign_table' => 'tx_ieb_domain_model_berater',
                'MM' => 'tx_ieb_ansuchen_berater_mm',
                'size' => 10,
                'autoSizeMax' => 30,
                'maxitems' => 9999,
                'multiple' => 0,
                'fieldControl' => [
                    'editPopup' => [
                        'disabled' => false,
                    ],
                    'addRecord' => [
                        'disabled' => false,
                    ],
                    'listModule' => [
                        'disabled' => true,
                    ],
                ],
            ],
            
        ],
    
    ],
];
