<?php
defined('TYPO3') || die();

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ieb',
    'Default',
    'IEB'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ieb',
    'Stamm',
    'IEB Stammdaten'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ieb',
    'Trainer',
    'IEB Trainer'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ieb',
    'Berater',
    'IEB Berater'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'Ieb',
    'Ansuchen',
    'IEB Ansuchen'
);
