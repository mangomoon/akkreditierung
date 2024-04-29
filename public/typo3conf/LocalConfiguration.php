<?php
return [
    'BE' => [
        'debug' => true,
        'explicitADmode' => 'explicitAllow',
        'installToolPassword' => '$argon2i$v=19$m=65536,t=16,p=1$Q0p2YlA0RmNFNlRwNUxiZw$xzwVIiY0Jr6p8GecCJGrlmPFftyf4WxIrVOcLa1TQCU',
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
    ],
    'DB' => [
        'Connections' => [
            'Default' => [
                'charset' => 'utf8mb4',
                'dbname' => 'u901414_akdb',
                'driver' => 'mysqli',
                'host' => 'db.mariadb103',
                'password' => 'X7vk8a5Keee$e6Cgg',
                'port' => '3306',
                'user' => 'u901414_akdb',
            ],
        ],
    ],
    'EXTCONF' => [
        'lang' => [
            'availableLanguages' => [
                'de',
            ],
        ],
    ],
    'EXTENSIONS' => [
        'backend' => [
            'backendFavicon' => '',
            'backendLogo' => '',
            'loginBackgroundImage' => '',
            'loginFootnote' => '',
            'loginHighlightColor' => '#c3161c',
            'loginLogo' => 'EXT:ieb/Resources/Public/Backend/levelup-logo.svg',
            'loginLogoAlt' => '',
        ],
        'extension_builder' => [
            'backupDir' => 'var/tx_extensionbuilder/backups',
            'backupExtension' => '1',
            'enableRoundtrip' => '1',
        ],
        'extensionmanager' => [
            'automaticInstallation' => '1',
            'offlineMode' => '0',
        ],
        'fe_passwordless' => [
            'allowedContexts' => 'Development/Ddev',
            'password' => 'ieb',
        ],
        'news' => [
            'advancedMediaPreview' => '1',
            'archiveDate' => 'date',
            'categoryBeGroupTceFormsRestriction' => '0',
            'categoryRestriction' => '',
            'contentElementPreview' => '1',
            'contentElementRelation' => '1',
            'dateTimeNotRequired' => '0',
            'hidePageTreeForAdministrationModule' => '0',
            'manualSorting' => '0',
            'mediaPreview' => 'false',
            'prependAtCopy' => '1',
            'resourceFolderImporter' => '/news_import',
            'rteForTeaser' => '0',
            'showAdministrationModule' => '1',
            'showImporter' => '0',
            'slugBehaviour' => 'unique',
            'storageUidImporter' => '1',
            'tagPid' => '1',
        ],
        'scheduler' => [
            'maxLifetime' => '1440',
            'showSampleTasks' => '1',
        ],
        'sierrha' => [
            'debugMode' => '0',
            'resourceExtensionRegexp' => 'css|eot|gif|ico|jpe?g|js(?:on)|png|svg|ttf|webp|woff2?|xml',
        ],
        't3adminer' => [
            'IPaccess' => '',
            'applyDevIpMask' => '0',
            'exportDirectory' => 'fileadmin',
        ],
    ],
    'FE' => [
        'debug' => true,
        'disableNoCacheParameter' => true,
        'lifetime' => 99999997,
        'pageNotFoundOnCHashError' => false,
        'passwordHashing' => [
            'className' => 'TYPO3\\CMS\\Core\\Crypto\\PasswordHashing\\Argon2iPasswordHash',
            'options' => [],
        ],
        'permalogin' => '1',
    ],
    'GFX' => [
        'processor' => 'GraphicsMagick',
        'processor_allowTemporaryMasksAsPng' => false,
        'processor_colorspace' => 'RGB',
        'processor_effects' => false,
        'processor_enabled' => true,
        'processor_path' => '/usr/bin/',
        'processor_path_lzw' => '/usr/bin/',
    ],
    'LOG' => [
        'TYPO3' => [
            'CMS' => [
                'deprecations' => [
                    'writerConfiguration' => [
                        'notice' => [
                            'TYPO3\CMS\Core\Log\Writer\FileWriter' => [
                                'disabled' => false,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'MAIL' => [
        'defaultMailFromAddress' => 'noreply@ieb.at',
        'defaultMailFromName' => 'IEB',
        'partialRootPaths' => [
            100 => 'EXT:ieb/Resources/Private/Partials/Mail/',
        ],
        'templateRootPaths' => [
            770 => 'EXT:ieb/Resources/Private/Templates/Mail/',
        ],
        'transport' => 'sendmail',
        'transport_sendmail_command' => '/usr/local/bin/mailhog sendmail test@example.org --smtp-addr 127.0.0.1:1025',
        'transport_smtp_encrypt' => '',
        'transport_smtp_password' => '',
        'transport_smtp_server' => '',
        'transport_smtp_stream_options' => [
            'ssl' => [
                'verify_peer' => false,
                'verify_peer_name' => false,
            ],
        ],
        'transport_smtp_username' => '',
    ],
    'SYS' => [
        'caching' => [
            'cacheConfigurations' => [
                'hash' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                ],
                'imagesizes' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
                'pages' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
                'pagesection' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
                'rootline' => [
                    'backend' => 'TYPO3\\CMS\\Core\\Cache\\Backend\\Typo3DatabaseBackend',
                    'options' => [
                        'compression' => true,
                    ],
                ],
            ],
        ],
        'devIPmask' => '*',
        'displayErrors' => 1,
        'encryptionKey' => 'e89b4fcd62fca9546a18ef3f6a1e42b76a1f281090385939fd1c7b62d880d5a34c7d6ccd9be31c5730cb9d628ba07318',
        'exceptionalErrors' => 12290,
        'features' => [
            'yamlImportsFollowDeclarationOrder' => true,
        ],
        'sitename' => 'IEB',
        'systemMaintainers' => [
            1,
            4,
        ],
    ],
];
