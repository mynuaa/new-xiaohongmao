<?php
namespace App\Domain;

include_once API_ROOT . '/src/classes/dingxiang/CaptchaClient.php';

class DXCode {

    public function valid($token){

        $appId = "069ae57274e54291f373478057e1d796";
        $appSecret = "b684a38e770f263dd1e306b26937363c";
        $client = new \CaptchaClient($appId,$appSecret);
        $client->setTimeOut(2);      //设置超时时间

        $response = $client->verifyToken($token);
        
        if($response->result){
            return true;
        }else{
            return false;
        }
        
    }

}
