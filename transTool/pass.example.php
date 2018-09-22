<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
require_once './Medoo.php';

use Medoo\Medoo;

$pass =  [
    'old' => [
        'username' => 'root',
        'password' => 'root'
    ],
    'new' => [
        'username' => 'root',
        'password' => 'root'
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
