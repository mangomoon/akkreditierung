<?php
defined('TYPO3') or die('Access denied.');


$GLOBALS['TYPO3_CONF_VARS']['SYS']['fluid']['namespaces']['m'][] = 'Mangomoon\\Mangomoon\\ViewHelpers';


/***************
 * PageTS
 */


// \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:mangomoon/Configuration/TsConfig/Page/All.tsconfig">');