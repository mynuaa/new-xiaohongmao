<?php
$pass =  [
    'old' => [
        'username' => 'volunteer',
        'password' => '657d640e70b996'
    ],
    'new' => [
        'username' => 'newvolunteer',
        'password' => 'newv01unT33#r'
    ],
];


$old = new Medoo(array_merge([
    'database_type' => 'mysql',
    'database_name' => 'volunteer',
    'server' => 'localhost',
    'charset' => 'utf8mb4',
    'port' => 3306,
    'prefix' => '',
], $pass['old']));

$new = new Medoo(array_merge([
    'database_type' => 'mysql',
    'database_name' => 'newvolunteer',
    'server' => 'localhost',
    'charset' => 'utf8mb4',
    'port' => 3306,
    'prefix' => '',
], $pass['new']));
