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
        [
            \GeorgRinger\Ieb\Controller\StaticBeraterController::class => 'create, update, delete',
            \GeorgRinger\Ieb\Controller\StandortController::class => 'list,show',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Stamm',
        [
            \GeorgRinger\Ieb\Controller\StammdatenController::class => 'index, list, new, update, create, edit',
        ],
        [
            \GeorgRinger\Ieb\Controller\StammdatenController::class => 'index, list, new, update, create, edit',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Trainer',
        [
            \GeorgRinger\Ieb\Controller\TrainerController::class => 'index, list, new, update, create, edit,show,archive,revive',
        ],
        [
            \GeorgRinger\Ieb\Controller\TrainerController::class => 'index, list, new, update, create, edit,show,archive,revive',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Berater',
        [
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'index, list, new, update, create, edit,show,archive,revive',
        ],
        [
            \GeorgRinger\Ieb\Controller\BeraterController::class => 'index, list, new, update, create, edit,show,archive,revive',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Standort',
        [
            \GeorgRinger\Ieb\Controller\StandortController::class => 'index, list, new, update, create, edit,show,archive,revive',
        ],
        [
            \GeorgRinger\Ieb\Controller\StandortController::class => 'index, list, new, update, create, edit,show,archive,revive',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Angebotssteuerung',
        [
            \GeorgRinger\Ieb\Controller\AngebotVerantwortlichController::class => 'index, list, show, new, edit, create, update, delete, unlock,archive,revive',
        ],
        [
            \GeorgRinger\Ieb\Controller\AngebotVerantwortlichController::class => 'index, list, show, new, edit, create, update, delete, unlock,archive,revive',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Ansuchen',
        [
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'list, show, new, edit, create, update, delete,einreichen,clone,unlock,archive,revive,certificateDownload',
        ],
        [
            \GeorgRinger\Ieb\Controller\AnsuchenController::class => 'list, show, new, edit, create, update, delete,einreichen,clone,unlock,archive,revive,certificateDownload',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'AnsuchenBegutachtung',
        [
            \GeorgRinger\Ieb\Controller\AnsuchenBegutachtungController::class => 'list,show,edit,update,finalizeStatus,zuteilung,zuteilungPersist,',
            \GeorgRinger\Ieb\Controller\TrainerBegutachtungController::class => 'list,show,edit,update',
            \GeorgRinger\Ieb\Controller\BeraterBegutachtungController::class => 'list,show,edit,update',
            \GeorgRinger\Ieb\Controller\StammdatenBegutachtungController::class => 'list,show,edit,update',
        ],
        [
            \GeorgRinger\Ieb\Controller\AnsuchenBegutachtungController::class => 'list, show,edit, update,finalizeStatus,zuteilung,zuteilungPersist,',
            \GeorgRinger\Ieb\Controller\TrainerBegutachtungController::class => 'list, show,edit, update',
            \GeorgRinger\Ieb\Controller\BeraterBegutachtungController::class => 'list,show,edit,update',
            \GeorgRinger\Ieb\Controller\StammdatenBegutachtungController::class => 'list, show,edit, update',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'User',
        [
            \GeorgRinger\Ieb\Controller\UserController::class => 'list, show, new, edit, create, update, archive, revive',
        ],
        [
            \GeorgRinger\Ieb\Controller\UserController::class => 'list, show, new, edit, create, update, archive, revive',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Widget',
        [
            \GeorgRinger\Ieb\Controller\UserController::class => 'list, show, new, edit, create, update, delete',
        ],
        [
            \GeorgRinger\Ieb\Controller\UserController::class => 'list, show, new, edit, create, update, delete',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'Ieb',
        'Registration',
        [
            \GeorgRinger\Ieb\Controller\RegistrationController::class => 'index, registrationForm, registrationSuccess, doubleOptIn,acceptInvitation, acceptInvitationSuccess',
        ],
        [
            \GeorgRinger\Ieb\Controller\RegistrationController::class => 'index, registrationForm, registrationSuccess, doubleOptIn,acceptInvitation, acceptInvitationSuccess',
        ]
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter(\GeorgRinger\Ieb\Domain\Property\TypeConverter\ObjectStorageConverter::class);
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter(\GeorgRinger\Ieb\Domain\Property\TypeConverter\UploadedFileReferenceConverter::class);
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerTypeConverter(\GeorgRinger\Ieb\Domain\Property\TypeConverter\UploadedFileReferencesConverter::class);

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(trim('
    config.pageTitleProviders {
        ieb {
            provider = GeorgRinger\Ieb\Seo\IebTitleProvider
            before = altPageTitle,record,seo
        }
    }
'));


    $GLOBALS['TYPO3_CONF_VARS']['SYS']['formEngine']['nodeRegistry'][1684948718] = [
        'nodeName' => 'json',
        'priority' => 40,
        'class' => \GeorgRinger\Ieb\Backend\Element\JsonElement::class,
    ];
})();
