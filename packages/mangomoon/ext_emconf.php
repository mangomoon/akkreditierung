<?php

/**
 * Extension Manager/Repository config file for ext "mangomoon".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'mangomoon',
    'description' => 't11',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '11.5.1-11.5.99',
            'fluid_styled_content' => '11.5.0-11.5.99',
            'rte_ckeditor' => '11.5.0-11.5.99',
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
    'version' => '11.0.6',
];
