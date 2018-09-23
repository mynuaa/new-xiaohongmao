<?php
namespace App\Domain;

include_once API_ROOT . '/src/classes/dingxiang/CaptchaClient.php';

class DXCode {

    /**
     * 初始化验证
     * @desc 初始化验证
     * @return int success success
     * @return string gt 验证 id，极验后台申请得到
     * @return string challenge 验证流水号，后服务端 SDK 向极验服务器申请得到
     * @return int new_captcha 宕机情况下使用，表示验证是 3.0 还是 2.0，3.0 的 sdk 该字段为 true
     */
    public function startCaptchaServlet($uid, $type = 'web') {
        return \PhalApi\DI()->gtcode->startCaptchaServlet([
            'user_id' => $uid,
            'client_type' => $type,
            'ip_address' => $_SERVER["REMOTE_ADDR"]
        ]);
    }

    /**
     * 二次验证
     * @desc 二次验证
     * @return int code 验证的结果，1表示成功，0表示失败
     */
    public function verifyLoginServlet($challenge, $validate, $seccode, $rand) {

        $code = \PhalApi\DI()->gtcode->verifyLoginServlet($challenge, $validate, $seccode, [
            'user_id' => $rand,
            'client_type' => 'web',
            'ip_address' => $_SERVER["REMOTE_ADDR"]
        ]);

        return $code;
    }

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
