<?php
namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception;
use PhalApi\Exception\BadRequestException;

use function \PhalApi\DI as di;

use App\Domain\Front as DFront;
use App\Domain\Ded as DDed;
use App\Domain\User as DUser;
use App\Domain\Activity as DActivity;
use App\Domain\Join as DJoin;
use App\Domain\Wechat as DWechat;

/**
 * 微信小程序接口
 *
 * @author: Seiry Yu
 */

class Wechat extends Api {


	public function getRules() {
        return [
            'getJoin' => [
                'id' => [
                    'name' => 'stuid', 
                    'desc' => '学号',
                    'format' => 'utf8',                    
                    'require' => true,
                    'type' => 'string',
                    'min' => 9,
                    'max' => 9
                ]
            ],
            '*' => [
                'session' => [
                    'name' => 'session', 
                    'desc' => '微信session',
                    'format' => 'utf8',                    
                    'require' => true,
                    'type' => 'string',
                ]
            ],
        ];
	}
    
    function __construct() {
        $this->Front = new DFront();
        //$this->GTCode = new DGTCode();
        $this->Ded = new DDed();
        $this->User = new DUser();
        $this->Act = new DActivity();
        $this->Join = new DJoin();
        $this->Wechat = new DWechat();
    }

    /**
     * 登录
     *
     * @return void
     */

    public function login(){

        $openid = $this->Wechat->sessionGetOpenid($this->session);
        if($openid === false){
            throw new Exception('登录无效', 503);
        }
        
        $ded = $this->Ded->verify($this->stuid, $this->passwd);
        if($ded === false){
            throw new Exception('密码错误', 403);
        }

        $admin = $this->User->isAdmin($this->stuid);
        return $this->User->encode($ded['name'], $this->stuid, $admin);

        if($this->Ded->binded($this->stuid)){//已经绑定 老用户
            //返回jwt
            $admin = $this->User->isAdmin($this->stuid);
            return $this->User->encode($ded['name'], $this->stuid, $admin);
        }else{
            // ？是否要激活？
            throw new Exception('请确认绑定', 200);
        }

        //判断是否是新注册
        //正常的业务逻辑
    }


    public function getJoin(){
        $re['time'] = $this->Join->getTime($this->id);
        $re['join'] = $this->Join->getByStuid($this->id);
        
        return $re;
    }
}
