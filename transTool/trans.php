<?php

require_once './Medoo.php';

use Medoo\Medoo;

$old = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'volunteer',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8mb4',
    'port' => 3306,
    'prefix' => '',
]);

$new = new Medoo([
    'database_type' => 'mysql',
    'database_name' => 'newvolunteer',
    'server' => 'localhost',
    'username' => 'root',
    'password' => 'root',
    'charset' => 'utf8mb4',
    'port' => 3306,
    'prefix' => '',
]);

$re = $old->select('activities', [
    '[>]activite_group' => ['act_group_id']
], [
    'aid',
    'hoster',
    'group_name',
    'type',
    'place(location)',
    'time_last(volunteertimemin)',
    'time_last(volunteertimemax)',
    'title',
    'title(summary)',
    'content(detail)',
    'update(lastupdate)',
    'time_beg(starttime)',
    'time_end'
], [
    'LIMIT' => 2
]);

return;
