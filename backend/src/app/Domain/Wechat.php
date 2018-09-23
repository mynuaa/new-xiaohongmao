<?php

namespace App\Domain;

class Wechat {

    function __construct() {

    }

    public function sessionGetOpenid($session){
        $appid = 'wxb432e5868c65bb6a';
        $appkey = '16204a475a328e16e6971bceae829200';
        $url = "https://api.weixin.qq.com/sns/jscode2session?appid={$appid}&secret={$appkey}&js_code={$session}&grant_type=authorization_code";
        //$url = 'https://me.yuwenjie.cc';
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => 2
        ]);
        $re = curl_exec($curl);
        curl_close($curl);

        $re = json_decode($re, true);

        if(isset($re['openid'])){
            return $re['openid'];
        }else{
            return false;
            return $re['errmsg'];
        }
    }
}
