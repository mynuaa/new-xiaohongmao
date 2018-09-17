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

}
