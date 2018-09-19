<?php
namespace App\Model;

use function \PhalApi\DI as di;

class User{

    public function isAdmin($id){
        $re = di()->db->get('admin', [
            'level',
            'yuan'
        ], [
            'stuid' => $id,
            'status[>]' => 0
        ]);
        return $re;

    }

    public function countAll(){
        $re = di()->db->count('user', [
            'status[>]' => 0
        ]);
        return $re;

    }
 
    public function getInfo($id){
        $re = di()->db->get('user', '*', [
            'stuid' => $id
        ]);
        return $re;
    }

}
