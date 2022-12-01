<?php
defined('TYPO3') || die();

(static function () {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Default',
        [
            \GeorgRinger\Ieb\Controller\StaticBeraterController::class => 'list, show, new, create, edit, update, delete',
            \GeorgRinger\Ieb\Controller\StandortController::class => 'list, show',
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\StaticBeraterController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\StandortController::class => '',
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
        'Berater',
        [
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'index, list, new, update, create, edit,show',
        ],
        [
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'index, list, new, update, create, edit,show',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Ansuchen',
        [
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'list, show, new, edit, create, update, delete,einreichen,clone',
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'list, show, new, edit, create, update, delete,einreichen,clone',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'AnsuchenBegutachtung',
        [
            \GeorgRinger\Ieb\Controller\AnsuchenBegutachtungController::class => 'list,show,edit,update',
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\AnsuchenBegutachtungController::class => 'list, show,edit, update',
        ]
    );


    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'User',
        [
            \GeorgRinger\Ieb\Controller\UserController::class => 'list, show, new, edit, create, update, delete',
        ],
        // non-cacheable actions
        [
            \GeorgRinger\Ieb\Controller\UserController::class => 'list, show, new, edit, create, update, delete',
        ]
    );

})();
