<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Type {

    public function get($tid){
        $re = di()->db->get('type', '*', [
            'typeid' => $tid
        ]);

        return $re;
    }

    public function getAll($all = false){
        if ($all == false) {
            $con = [
                'status[>]' => 0
            ];
        }else{
            $con = [];
        }
    
        $re = di()->db->select('type', '*', $con);

        return $re;
    }
    
    public function add($name, $level){
        $re = di()->db->insert('type', [
            'typename' => $name,
            'typelevel' => $level
        ]);

        if(di()->db->error()[0] == 0){
            return di()->db->id();
        }else{
            return false;
        }
    }


}
