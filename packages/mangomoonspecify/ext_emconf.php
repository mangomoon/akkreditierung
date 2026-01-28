<?php

/**
 * Extension Manager/Repository config file for ext "mangomoonspecify".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'mangomoonspecify',
    'description' => 't12 specify',
    'category' => 'templates',
    'constraints' => [
        'depends' => [
            'typo3' => '13.4.0-13.4.99',
            'fluid_styled_content' => '13.4.0-13.4.99',
            'rte_ckeditor' => '13.4.0-13.4.99',
            'mangomoon' => ''
        ],
        'conflicts' => [
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Mangomoon\\Mangomoonspecify\\' => 'Classes',
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
