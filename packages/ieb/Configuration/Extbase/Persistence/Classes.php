<?php

declare(strict_types=1);

return [
    \GeorgRinger\Ieb\Domain\Model\User::class => [
        'tableName' => 'fe_users',
    ],
    \GeorgRinger\Ieb\Domain\Model\FileReference::class => [
        'tableName' => 'sys_file_reference',
    ],
];
