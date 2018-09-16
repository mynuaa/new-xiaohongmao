<?php
namespace App\Domain;

//use App\Model\Examples\CURD as ModelCURD;
//use App\Model\Ded as MDed;

use function \PhalApi\DI as di;

class User {

    function __construct() {
        // $this->MDed = new MDed();
    }


    public function decode($jwt){
        return di()->jwt->decodeJwtByParam($jwt);
    }

    public function encode($uname, $uid, $admin = false){
        /*
        $admin = {
            level: [int],
                1,//学院管理员
                2,//校管理员
                3 //炒鸡管理员
            yuan: [int]
                1-17
        }
        普通用户为false
        */
        return di()->jwt->encodeJwt([
            'uname' => $uname,
            'uid' => $uid,
            'admin' => $admin
        ]);
    }
}
