<?php

/**
 * Extension Manager/Repository config file for ext "mangomoon".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'mangomoon',
    'description' => 't13',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'fluid_styled_content' => '13.4.0-13.4.99',
            'rte_ckeditor' => '13.4.0-13.4.99',
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Mangomoon\\Mangomoon\\' => 'Classes',
        ],
    ],
    'state' => 'stable',
    'uploadfolder' => 0,
    'createDirs' => '',
    'clearCacheOnLoad' => 1,
    'author' => 'Michael Shorny',
    'author_email' => 'michael.shorny@mangomoon.at',
    'author_company' => 'mangomoon',
    'version' => '13.0.1',
];
