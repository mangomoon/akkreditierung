<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Default',
        [
            \GeorgRinger\Ieb\Controller\TrainerController::class => 'list, show, new, create, edit, update, delete',
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'list, show, new, create, edit, update, delete',
            \GeorgRinger\Ieb\Controller\StandortController::class => 'list, new, create, edit, update, delete',
            \GeorgRinger\Ieb\Controller\StammdatenController::class => 'list, show, new, create, edit, update',
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'list, show, new, create, edit, update, delete',
            \GeorgRinger\Ieb\Controller\AngebotVerantwortlichController::class => 'list, show, new, create, edit, update'
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\TrainerController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\StandortController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\StammdatenController::class => 'create, update',
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\AngebotVerantwortlichController::class => 'create, update'
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
                }
                show = *
            }
       }'
    );
})();
