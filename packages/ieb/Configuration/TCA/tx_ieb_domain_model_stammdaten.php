<?php
return [
    'ctrl' => [
        'title' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten',
        'label' => 'name',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
            'starttime' => 'starttime',
            'endtime' => 'endtime',
        ],
        'searchFields' => 'name,markenname,strasse,ort,seit,website,email,telefon,leitbild,qms_zertifikat,qualitaet_sicherung,qualitaet_personal,review_a1_comment_internal,review_a1_comment_tr,review_a1_comment_internal_step,review_a2_comment_internal,review_a2_comment_internal_step,review_a2_comment_tr',
        'iconfile' => 'EXT:ieb/Resources/Public/Icons/tx_ieb_domain_model_stammdaten.gif'
    ],
    'types' => [
        '1' => ['showitem' => 'name, markenname, nachweis, rechtsform, strasse, plz, ort, seit, website, email, telefon, leitbild, leitbild_datei, qms_zertifikat_datei, qms_zertifikat, qms_typ, qualitaet_sicherung, zertifikat_bis, qualitaet_sicherung_datei, qualitaet_personal, qualitaet_personal_datei, tr_pp3, locked_by, ok, weiterbildung_erklaerung, review_a1_status, review_a1_comment_internal, review_a1_comment_tr, review_a1_comment_internal_step, review_a2_status, review_a2_comment_internal, review_a2_comment_internal_step, review_a2_comment_tr, review_oecert_frist, review_oecert_frist_mail_sent14t, review_oecert_frist_mail_sent1t, status_after_review, --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access, hidden, starttime, endtime'],
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

        'name' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.name',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.name.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'markenname' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.markenname',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.markenname.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'nachweis' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.nachweis',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.nachweis.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'nachweis',
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
                        'fieldname' => 'nachweis',
                        'tablenames' => 'tx_ieb_domain_model_stammdaten',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'rechtsform' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.rechtsform',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.rechtsform.description',
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
        'strasse' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.strasse',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.strasse.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'plz' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.plz',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.plz.description',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'ort' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.ort',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.ort.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'seit' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.seit',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.seit.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'website' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.website',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.website.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'email' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.email',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.email.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'telefon' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.telefon',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.telefon.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'leitbild' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.leitbild',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.leitbild.description',
            'config' => [
                'type' => 'input',
                'size' => 30,
                'eval' => 'trim',
                'default' => ''
            ],
        ],
        'leitbild_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.leitbild_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.leitbild_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'leitbild_datei',
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
                        'fieldname' => 'leitbild_datei',
                        'tablenames' => 'tx_ieb_domain_model_stammdaten',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'qms_zertifikat_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qms_zertifikat_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qms_zertifikat_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'qms_zertifikat_datei',
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
                        'fieldname' => 'qms_zertifikat_datei',
                        'tablenames' => 'tx_ieb_domain_model_stammdaten',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'qms_zertifikat' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qms_zertifikat',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qms_zertifikat.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'qms_typ' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qms_typ',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qms_typ.description',
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
        'qualitaet_sicherung' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qualitaet_sicherung',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qualitaet_sicherung.description',
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
        'zertifikat_bis' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.zertifikat_bis',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.zertifikat_bis.description',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 7,
                'eval' => 'date',
                'default' => time()
            ],
        ],
        'qualitaet_sicherung_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qualitaet_sicherung_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qualitaet_sicherung_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'qualitaet_sicherung_datei',
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
                        'fieldname' => 'qualitaet_sicherung_datei',
                        'tablenames' => 'tx_ieb_domain_model_stammdaten',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'qualitaet_personal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qualitaet_personal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qualitaet_personal.description',
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
        'qualitaet_personal_datei' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qualitaet_personal_datei',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.qualitaet_personal_datei.description',
            'config' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::getFileFieldTCAConfig(
                'qualitaet_personal_datei',
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
                        'fieldname' => 'qualitaet_personal_datei',
                        'tablenames' => 'tx_ieb_domain_model_stammdaten',
                        'table_local' => 'sys_file',
                    ],
                    'maxitems' => 1
                ]
            ),
            
        ],
        'tr_pp3' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.tr_pp3',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.tr_pp3.description',
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
        'locked_by' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.locked_by',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.locked_by.description',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
        'ok' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.ok',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.ok.description',
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
        'weiterbildung_erklaerung' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.weiterbildung_erklaerung',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.weiterbildung_erklaerung.description',
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
        'review_a1_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a1_status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a1_status.description',
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
        'review_a1_comment_internal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a1_comment_internal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a1_comment_internal.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_a1_comment_tr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a1_comment_tr',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a1_comment_tr.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_a1_comment_internal_step' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a1_comment_internal_step',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a1_comment_internal_step.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_a2_status' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a2_status',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a2_status.description',
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
        'review_a2_comment_internal' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a2_comment_internal',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a2_comment_internal.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_a2_comment_internal_step' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a2_comment_internal_step',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a2_comment_internal_step.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_a2_comment_tr' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a2_comment_tr',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_a2_comment_tr.description',
            'config' => [
                'type' => 'text',
                'cols' => 40,
                'rows' => 15,
                'eval' => 'trim',
                'default' => ''
            ]
        ],
        'review_oecert_frist' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_oecert_frist',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_oecert_frist.description',
            'config' => [
                'type' => 'input',
                'renderType' => 'inputDateTime',
                'size' => 7,
                'eval' => 'date',
                'default' => time()
            ],
        ],
        'review_oecert_frist_mail_sent14t' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_oecert_frist_mail_sent14t',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_oecert_frist_mail_sent14t.description',
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
        'review_oecert_frist_mail_sent1t' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_oecert_frist_mail_sent1t',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.review_oecert_frist_mail_sent1t.description',
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
        'status_after_review' => [
            'exclude' => true,
            'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.status_after_review',
            'description' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_stammdaten.status_after_review.description',
            'config' => [
                'type' => 'input',
                'size' => 4,
                'eval' => 'int',
                'default' => 0
            ]
        ],
    
    ],
];
