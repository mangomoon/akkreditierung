<?php
defined('TYPO3_MODE') || die();


$GLOBALS['TYPO3_CONF_VARS']['RTE']['Presets']['mangomoon'] = 'EXT:mangomoonspecify/Configuration/RTE/mangomoon.yaml';

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:mangomoonspecify/Configuration/TsConfig/TCEFORM.tsconfig">');