<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Ded{

    public function hasDed($stuid){
        if(preg_match("/[a-zA-Z]{2}/",$this->stuid)){//判断是否为研究生
            return di()->db->get('suser', 'uid', [
                'stuid' => $stuid
                ]);
        }
        else{
            return di()->db->get('user', 'uid', [
            'stuid' => $stuid
            ]);
        }    
    }
}
