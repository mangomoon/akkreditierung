<?php

/**
 * Extension Manager/Repository config file for ext "mangomoonspecify".
 */
$EM_CONF[$_EXTKEY] = [
    'title' => 'mangomoonspecify',
    'description' => 't11 specify',
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
    'version' => '11.0.1',
];
