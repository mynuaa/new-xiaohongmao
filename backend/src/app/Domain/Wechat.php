<?php

namespace App\Domain;

use App\Model\Wechat as MWechat;

class Wechat {

    function __construct() {
        $this->Wechat = new MWechat();
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

    public function checkOpenid($openId){
        // 检查数据库是否有传入的openId，证明是否有人绑定此微信号
        return $this->Wechat->checkOpenid($openId);
    }

    public function setOpenid($stuid, $openid){
        // 把学号和openid绑定
        return $this->Wechat->setOpenid($stuid, $openid);
    }

}
