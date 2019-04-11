<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Hoster {

    public function get($hid){
        $re = di()->db->get('hoster', '*', [
            'hid' => $hid
        ]);

        return $re;
    }

    public function getAll(){
        $re = di()->db->select('hoster', '*');

        return $re;
    }
    
    public function add($name, $nickname){
        $re = di()->db->insert('hoster', [
            'hostname' => $name,
            'hostnickname' => $nickname
        ]);

        if(di()->db->error()[0] == 0){
            return di()->db->id();
        }else{
            return false;
        }
    }


}
