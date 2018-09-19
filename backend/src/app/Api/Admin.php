<?php
namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception;
use PhalApi\Exception\BadRequestException;

use function \PhalApi\DI as di;

use App\Domain\Front as DFront;
use App\Domain\GTCode as DGTCode;
use App\Domain\Ded as DDed;
use App\Domain\User as DUser;
use App\Domain\Activity as DActivity;
use App\Domain\Join as DJoin;

/**
 * 管理员功能
 *
 * @author: Seiry Yu
 */

class Admin extends Api {


	public function getRules() {
        return [
            'beforeLogin' => [
                'stuid' => [
                    'name' => 'stuid', 
                    'desc' => '学号',
                    'format' => 'utf8',                    
                    'require' => true,
                    'type' => 'string',
                ],
            ],
            'login' => [
                'stuid' => [
                    'name' => 'stuid', 
                    'desc' => '学号',
                    'format' => 'utf8',                    
                    'require' => true,
                    'type' => 'string',
                ],
                'passwd' => [
                    'name' => 'passwd', 
                    'desc' => '学号',
                    'format' => 'utf8',                    
                    'require' => true,
                    'type' => 'string',
                ],
                'challenge' => [
                    'name' => 'challenge', 
                    'desc' => '验证码',
                    'format' => 'utf8',                    
                    'require' => true,
                    'type' => 'string',
                ],
                'validate' => [
                    'name' => 'validate', 
                    'desc' => '验证码',
                    'format' => 'utf8',                    
                    'require' => true,
                    'type' => 'string',
                ],
                'seccode' => [
                    'name' => 'seccode', 
                    'desc' => '验证码',
                    'format' => 'utf8',                    
                    'require' => true,
                    'type' => 'string',
                ]
            ],
            'addActivity' => [
                'name' => [
                    'name' => 'name', 
                    'require' => true,
                    'type' => 'string',
                    'format' => 'utf8',       
                    'desc' => '活动名称'
                ],
                'location' => [
                    'name' => 'location', 
                    'require' => true,
                    'type' => 'string',
                    'format' => 'utf8',       
                    'desc' => '活动地点'
                ],
                'hoster' => [
                    'name' => 'hoster', 
                    'require' => true,
                    'type' => 'int',     
                    'desc' => '活动地点'
                ],
                'title' => [
                    'name' => 'title', 
                    'require' => true,
                    'type' => 'string',
                    'desc' => '标题'
                ],
                'summary' => [
                    'name' => 'summary', 
                    'require' => true,
                    'type' => 'string',
                    'desc' => '简介'
                ],
                'detail' => [
                    'name' => 'detail', 
                    'require' => true,
                    'type' => 'string',
                    'desc' => '详情'
                ],
                'peoplenum' => [
                    'name' => 'peoplenum', 
                    'require' => true,
                    'type' => 'int',
                    'min' => 1,
                    'desc' => '人数'
                ],
                'alltime' => [
                    'name' => 'alltime', 
                    'require' => true,
                    'type' => 'int',
                    'min' => 1,
                    'desc' => '所有时间'
                ],
                'contact' => [
                    'name' => 'contact', 
                    'require' => true,
                    'type' => 'string',
                    'desc' => '联系方式'
                ],
                'starttime' => [
                    'name' => 'starttime', 
                    'require' => true,
                    'type' => 'int',
                    'desc' => '开始时间'
                ],
                'volunteertimemin' => [
                    'name' => 'volunteertimemin', 
                    'require' => true,
                    'type' => 'float',
                    'desc' => '最少志愿时间'
                ],
                'volunteertimemax' => [
                    'name' => 'volunteertimemax', 
                    'require' => true,
                    'type' => 'float',
                    'desc' => '最少志愿时间'
                ],
                'type' => [
                    'name' => 'type', 
                    'require' => false,
                    'type' => 'int',
                    'desc' => '类型'
                ],
                'serviceConcept' => [
                    'name' => 'serviceConcept', 
                    'require' => true,
                    'type' => 'string',
                    'desc' => '服务信条'
                ],
                'workStartTime' => [
                    'name' => 'workStartTime', 
                    'require' => true,
                    'type' => 'string',
                    'desc' => '开门时间'
                ],
                'workEndTime' => [
                    'name' => 'workEndTime', 
                    'require' => true,
                    'type' => 'string',
                    'desc' => '停业时间'
                ],
                'award' => [
                    'name' => 'award', 
                    'require' => true,
                    'type' => 'string',
                    'desc' => '奖项'
                ],
                'address' => [
                    'name' => 'address', 
                    'require' => true,
                    'type' => 'string',
                    'desc' => '地址'
                ],
                'note1' => [
                    'name' => 'note1', 
                    'require' => false,
                    'type' => 'string',
                    'desc' => '文字1'
                ],
                'note2' => [
                    'name' => 'note2', 
                    'require' => false,
                    'type' => 'string',
                    'desc' => '文字2'
                ],
            ],
            '*' => [
                'jwt' => [
                    'name' => 'jwt', 
                    'desc' => '凭证',
                    'format' => 'utf8',                    
                    'require' => false,
                    'type' => 'string',
                ],
            ]
        ];
	}
    
    function __construct() {
        $this->Front = new DFront();
        $this->GTCode = new DGTCode();
        $this->Ded = new DDed();
        $this->User = new DUser();
        $this->Act = new DActivity();
        $this->Join = new DJoin();
    }

    /**
     * 登录之前获取chanllenge
     *
     * @return strings 挑战id
     */
    public function beforeLogin(){
        return $this->GTCode->startCaptchaServlet($this->stuid);
    }
    
    /**
     * 登录
     *
     * @return void
     */

    public function login(){
        
        /*$geetest = $this->GTCode->verifyLoginServlet($this->challenge, $this->validate, $this->seccode, $this->stuid);
        if($geetest !== true){
            throw new Exception('验证码错误', 500);
        }*/
        
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


    private function checkJwt(){
        $re = $this->User->decode($this->jwt);
        if(isset($re['ret']) && $re['ret'] == 401){
            throw new Exception($re['msg'], 401);
        }
        return $re;
    }
    public function makejwt(){
        return $this->User->encode('seiry', '031630226', ['level' => 3]);
    }
}
