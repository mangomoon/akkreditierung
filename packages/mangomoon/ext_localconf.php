<?php
defined('TYPO3_MODE') || die();


$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['m'][] = 'Mangomoon\\Mangomoon\\ViewHelpers';



/***************
 * PageTS
 */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:mangomoon/Configuration/TsConfig/Page/RTE.tsconfig">');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:mangomoon/Configuration/TsConfig/Page/TCEFORM.tsconfig">');
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:mangomoon/Configuration/TsConfig/Page/TCEMAIN.tsconfig">');