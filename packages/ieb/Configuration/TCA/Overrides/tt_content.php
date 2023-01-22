<?php
defined('TYPO3') || die();

$plugins = [
    'Default' => 'IEB',
    'Stamm' => 'IEB Stammdaten',
    'Trainer' => 'IEB Trainer',
    'Berater' => 'IEB Berater',
    'Ansuchen' => 'IEB Ansuchen',
    'AnsuchenBegutachtung' => 'IEB Ansuchen Begutachtung',
    'User' => 'IEB User',
    'Standort' => 'IEB Standort',
    'Widget' => 'IEB Widget',
    'Registration' => 'IEB Registration',
];

foreach ($plugins as $key => $title) {
    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
        'Ieb',
        $key,
        $title
    );
}