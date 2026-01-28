<?php
defined('TYPO3') || die();

$GLOBALS['TCA']['tt_content']['columns']['imagecols']['config']['default'] = 1;

$temporaryCopyright = array(
    'copyright' => array (
        'exclude' => 0,
        'label' => 'Copyright',
        'config' => array (
            'type' => 'input',
            'nullable' => true,
            'placeholder' => '__row|uid_local|metadata|copyright',
            'mode' => 'useOrOverridePlaceholder',
        )
    )
);
 

// add field to tca
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'sys_file_reference',
    $temporaryCopyright
);
 

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addFieldsToPalette(
    'sys_file_reference',
    'imageoverlayPalette',
    'copyright'
);