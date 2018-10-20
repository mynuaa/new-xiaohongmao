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

    public function checkOpenid($session, $openId){
        // 检查数据库是否有传入的openId，证明是否有人绑定此微信号
    }

    public function updateUser($stuid, $openId){
        // 更新openId wx用户 的数据
        // 如果这个人没有在小红帽网站注册过（所以数据库里没有关于他的stuid、gender、uname这类信息），但他的确是南航的学生，这时提示他
        // 去小红帽官网先注册？？ 
    }

    public function returnActivity($stuid){
        // 根据学号 返回志愿活动列表 及 志愿时长
        // 但其他的里面应该有
    }
}
