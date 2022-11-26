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
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\StaticBeraterController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\StandortController::class => '',
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'create, update, delete',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Stamm',
        [
            \GeorgRinger\Ieb\Controller\StammdatenController::class => 'index, list, new, update, create, edit',
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\StammdatenController::class => 'index, list, new, update, create, edit',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Trainer',
        [
            \GeorgRinger\Ieb\Controller\TrainerController::class => 'index, list, new, update, create, edit,show',
        ],
        [
            \GeorgRinger\Ieb\Controller\TrainerController::class => 'index, list, new, update, create, edit,show',
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

})();
