<?php 


return [
    'medoo' => [
    'database_type' => 'mysql',
    'database_name' => 'newvolunteer',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
	'charset' => 'utf8mb4',
	'port' => 3306,
	'prefix' => '',
	//'socket' => '/tmp/mysql.sock',
    ],
    'redis' => [
        'type' => '', //unix
        'socket' => '', //unix对应
        'host' => '127.0.0.1',
        'port' => '6379',
        'timeout' => 300,
        'prefix' => 'phalapi:',
        'auth' => '',
        'db' => 0
    ]
];
