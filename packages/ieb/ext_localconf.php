<?php
defined('TYPO3') || die();

(static function() {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Default',
        [
            \GeorgRinger\Ieb\Controller\TrainerController::class => 'list',
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'list',
            \GeorgRinger\Ieb\Controller\StandortController::class => 'list',
            \GeorgRinger\Ieb\Controller\StammdatenController::class => 'list',
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'list, show'
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\TrainerController::class => '',
            \GeorgRinger\Ieb\Controller\BeraterController::class => '',
            \GeorgRinger\Ieb\Controller\StandortController::class => '',
            \GeorgRinger\Ieb\Controller\StammdatenController::class => '',
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => ''
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
