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

$re = $old->select('join', [
    '[>]user' => ['uid']
], [
    'join_id(jid)',
    'aid',
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
], [
    'LIMIT' => 2
]);

foreach ($re as $v) {
    $v['hoster'] = changeHoster($v['hoster']);
    if($v['hoster'] == 0){
        $v['level'] = 1;
    }else{
        $v['level'] = 0;
    }
    $v['peoplenum'] = 10;
    $v['alltime'] = $v['peoplenum'] * $v['volunteertimemin'];
    $v['contact'] = 'qq 2269871810 微信公众号 nuaazfj';
    
    $new->insert('activity',$v);
    var_dump($new->error());
}

echo 0;
