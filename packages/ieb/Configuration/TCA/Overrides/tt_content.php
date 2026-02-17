<?php
defined('TYPO3') || die();

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;


$plugins = [
    'Default' => 'IEB',
    'Stamm' => 'IEB :: Stammdaten',
    'Trainer' => 'IEB :: Trainer',
    'Berater' => 'IEB :: Berater',
    'Ansuchen' => 'IEB :: Ansuchen',
    'AnsuchenArchiv' => 'IEB :: Ansuchen Archiv',
    'Angebotssteuerung' => 'IEB :: Angebotssteuerung',
    'AnsuchenBegutachtung' => 'IEB :: Ansuchen Begutachtung',
    'User' => 'IEB :: User',
    'Standort' => 'IEB :: Standort',
    'Widget' => 'IEB :: Widget',
    'Registration' => 'IEB :: Registration',
    'Reporting' => 'IEB :: Reporting',
    'PersonSearch' => 'IEB :: Personensuche',
    'ExternalView' => 'IEB :: Externe Ansicht',
    'Esf' => 'IEB :: ESF Reporting',
];

foreach ($plugins as $key => $title) {
    ExtensionUtility::registerPlugin(
        'Ieb',
        $key,
        $title,
        'bla',
        'ieb'
    );
}