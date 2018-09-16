<?php

$db = require __DIR__ . '/config/database.php';

return [
    'paths' => [
        'migrations' => 'database/migrations',
        'seeds' => 'database/seeds',
    ],
    'environments' => [
        'default_migration_table' => 'migrations',
        'default_database' => 'dev',
        'dev' => [
            'adapter' => $db['type'],
            'host' => $db['db_host'],
            'name' => $db['db_name'],
            'user' => $db['db_user'],
            'pass' => $db['db_pwd'],
            'port' => $db['db_port'],
            'table_prefix' => $db['db_prefix'],
            'charset' => $db['db_charset'],
            'collation' => 'utf8_unicode_ci'
        ]
    ]
];
