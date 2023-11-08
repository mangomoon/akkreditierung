<?php
defined('TYPO3') || die();

$columns = [
    'tr_admin' => [
        'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_user.tr_admin',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ],
            ],
            'default' => 0,
        ],
    ],
    'archiviert' => [
        'label' => 'LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_domain_model_user.archiviert',
        'config' => [
            'type' => 'check',
            'renderType' => 'checkboxToggle',
            'items' => [
                [
                    0 => '',
                    1 => '',
                ],
            ],
            'default' => 0,
        ],
    ],

    'ausschluss' => [
        'label' => 'Ausschluss',
        'config' => [
            'type' => 'text',

            'default' => '',
        ],
    ],

];

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns('fe_users', $columns);
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'tr_admin', '', 'after:username');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'archiviert', '', 'after:tr_admin');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes('fe_users', 'ausschluss', '', 'after:archiviert');