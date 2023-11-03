<?php
defined('TYPO3') || die();

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
];

foreach ($plugins as $key => $title) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Ieb',
        $key,
        $title
    );
}

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_excludelist']['ieb_ansuchen'] = 'recursive,select_key,pages';
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['ieb_ansuchen'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'ieb_ansuchen',
    'FILE:EXT:ieb/Configuration/FlexForms/flexform_ansuchen.xml'
);