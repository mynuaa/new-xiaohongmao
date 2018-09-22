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
    'time_last(timelong)',
    'sub_time',
    'status',
    'stu_num(stuid)'
]);


foreach ($re as $j) {
    if($j['status'] == 5){//没有审核通过
        $j['status'] = 0; //兼容状态
    }else{//不需要兼容
        if($j['status'] == 1){//已经审核通过
            $j['status'] = $j['sub_time'];
        }else{//暂时没有审核呢
            $j['status'] = 1;
        }
    }
    unset($j['sub_time']);
    $j['optadmin'] = 'trans';
    
    $new->insert('join',$j);
    var_dump($new->error());
}

echo 0;
