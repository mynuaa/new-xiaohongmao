<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Wechat{
    
    public function checkOpenid($openId){
        $re = di()->db->has("user", ["openId" => $openId]);

        return $re;
    }


    public function setOpenid($stuid, $openid){
        $re = di()->db->update("user", [
            "openid" => $openid
        ],[
            "stuid" => $openid
        ]);

        if(di()->db->error()[0] == 0){
            return true;
        }else{
            return false;
        }
        
    }
}
