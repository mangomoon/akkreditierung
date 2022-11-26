<?php
defined('TYPO3') || die();

(static function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Default',
        [
            \GeorgRinger\Ieb\Controller\StaticBeraterController::class => 'list, show, new, create, edit, update, delete',
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'list, show, new, create, edit, update, delete',
            \GeorgRinger\Ieb\Controller\StandortController::class => 'list, show',
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'index, list, show, new, create, edit, update, delete',
            \GeorgRinger\Ieb\Controller\TrainerController::class => 'index, list, show, new, create, edit, update, delete',
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\StaticBeraterController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\StandortController::class => '',
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\TrainerController::class => 'create, update, delete',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Stamm',
        [
            \GeorgRinger\Ieb\Controller\StammdatenController::class => 'index, list, new,update, create,edit',
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\StammdatenController::class => 'index, list, new,update,create,edit',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Ansuchen',
        [
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'list, show, new, edit, delete',
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'list, show, new, edit, delete',
        ]
    );

    // wizards
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
        'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    default {
                        iconIdentifier = ieb-plugin-default
                        title = LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_default.name
                        description = LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_default.description
                        tt_content_defValues {
                            CType = list
                            list_type = ieb_default
                        }
                    }
                    stamm {
                        iconIdentifier = ieb-plugin-stamm
                        title = LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_stamm.name
                        description = LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_stamm.description
                        tt_content_defValues {
                            CType = list
                            list_type = ieb_stamm
                        }
                    }
                    ansuchen {
                        iconIdentifier = ieb-plugin-ansuchen
                        title = LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_ansuchen.name
                        description = LLL:EXT:ieb/Resources/Private/Language/locallang_db.xlf:tx_ieb_ansuchen.description
                        tt_content_defValues {
                            CType = list
                            list_type = ieb_ansuchen
                        }
                    }
                }
                show = *
            }
       }'
    );
})();
