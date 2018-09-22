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

$re = $old->select('user', [
    'stu_num(stuid)',
    'name(uname)',
    'sex(gender)',
    'adminid',
    'update(updatetime)',
]);


foreach ($re as $u) {

    if($u['gender'] == 1){
        $u['gender'] = '男';
    }else{
        $u['gender'] = '女';
    }

    if($u['adminid'] < 3 ){//未激活的
        $u['status'] = 1;
    }else{//正式用户就直接激活
        $u['status'] = $u['updatetime'];
    }

    unset($u['adminid']);

    $new->insert('user',$u);
    if($new->error()[0] != 0){
        var_dump($new->error()[2]);
    }
}
