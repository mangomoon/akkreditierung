<?php
defined('TYPO3_MODE') || die();

$temporaryCopyright = array(
    'copyright' => array (
        'exclude' => 0,
        'label' => 'Copyright',
        'config' => array (
            'type' => 'input',
            'eval' => 'null',
            'placeholder' => '__row|uid_local|metadata|copyright',
            'mode' => 'useOrOverridePlaceholder',
        )
    )
);
 

$GLOBALS['TCA']['tt_content']['columns']['imagecols']['config']['default'] = 1;


// add field to tca
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'sys_file_reference',
    $temporaryCopyright
);
 
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addToAllTCAtypes(
    'sys_file_reference',
    'copyright',
    '',
    'before:description'
);
 

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'sys_file_reference',
    'imageoverlayPalette',
    'copyright'
);