<?php
defined('TYPO3') || die();

call_user_func(function()
{
    /**
     * Default TypoScript for Mangomoon
     */
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'mangomoon',
        'Configuration/TypoScript',
        'mangomoon'
    );
});
    // \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    //     'mangomoon',
    //     'Configuration/TypoScript',
    //     'mangomoon'
    // );


// Description -> RTE
$tempColumns = [
    'description' => array(
        'label' => 'Bildtext',
        'config' => array(
            'type' => 'text',
            'enableRichtext' => true,
            'cols' => 40,
            'rows' => 15,
            'eval' => 'trim'
        )
    ),
];
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTCAcolumns(
    'sys_file_reference',
    $tempColumns,
    1
);


// Page: Abstract -> RTE
$GLOBALS['TCA']['pages']['columns']['abstract'] = [
            'label' => 'Teaser',
              'config' => array(
                  'type' => 'text',
                  'enableRichtext' => true,
                  'cols' => 40,
                  'rows' => 5,
                  'eval' => 'trim'
              )
            ];

$GLOBALS['TCA']['fe_users']['columns']['description'] = [
            'label' => 'Bio',
              'config' => array(
                  'type' => 'text',
                  'enableRichtext' => true,
                  'cols' => 40,
                  'rows' => 5,
                  'eval' => 'trim'
              )
            ];