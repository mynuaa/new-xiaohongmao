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
                    'desc' => '活动举办者'
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
                    'require' => true,
                    'type' => 'int',
                    'desc' => '类型 先获取所有的type，如果不存在则先进行添加'
                ],
                'level' => [
                    'name' => 'level', 
                    'require' => true,
                    'type' => 'int',
                    'desc' => '级别，0为院级，1为校级',
                    'min' => 0,
                    'max' => 1
                ],
            ],
            'allActivity' => [
                'from' => [
                    'name' => 'from', 
                    'desc' => '分页起始',
                    'type' => 'int',
                    'default' => 0, 
                ],
                'pagenum' => [
                    'name' => 'pagenum', 
                    'desc' => '页面大小',
                    'type' => 'int',
                    'default' => 20, 
                ]
            ],
            'addJoin' => [
                'stuid' => [
                    'name' => 'stuid', 
                    'desc' => '学号',
                    'format' => 'utf8',                    
                    'require' => true,
                    'type' => 'string',
                ],
                'aid' => [
                    'name' => 'aid',
                    'desc' => '活动id',
                    'type' => 'int',
                    'require' => true,
                ],
                'timelong' => [
                    'name' => 'timelong',
                    'desc' => '时长',
                    'require' => true,
                    'type' => 'float'
                ]
            ],
            'getActivity' => [
                'aid' => [
                    'name' => 'aid',
                    'desc' => '活动id',
                    'type' => 'int',
                    'require' => true,
                ]
            ],
            'bindUser'=>[
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
        /*
        $geetest = $this->GTCode->verifyLoginServlet($this->challenge, $this->validate, $this->seccode, $this->stuid);
        if($geetest !== true){
            throw new Exception('验证码错误', 500);
        }
        */
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
            //todo 怎么搞？
            throw new Exception('请确认绑定', 200);
        }

        //判断是否是新注册
        //正常的业务逻辑
    }

    /**
     * 获取所有志愿活动 显示被删除的
     *
     * @return void
     */
    public function allActivity(){
        $re = $this->Act->gets($this->from, $this->pagenum, true);

        return $re;
    }

    /**
     * 增加活动
     *
     * @return void
     */
    public function addActivity(){

        $jwt = $this->checkJwt();

        if($jwt['admin'] == false){
            throw new Exception('无权限', 403);
        }

        if($jwt['admin']->level == 1){//院级管理员
            if($jwt['admin']->yuan != $this->hoster || $this->level == 1){//无权发布他院活动 无权发布校级活动
                throw new Exception("没这么高的权限", 403);
            }
        }

        $re = $this->Act->add($this);

        return $re;
    }

    /**
     * 增加参与
     *
     * @return void
     */
    public function addJoin(){
        $jwt = $this->checkJwt();
        
        if($jwt['admin'] == false){
            throw new Exception('无权限', 403);
        }

        if($jwt['admin']->level == 1){//院级管理员
            if(!$this->Act->judge($jwt['admin']->yuan, $this->aid)){
                throw new Exception("无权限", 403);
            }
        }
        // 去重通过硬件写死数据库实现
        $re = $this->Join->add($this->stuid, $this->aid, $this->timelong, $jwt['stuid']);

        if($re){
            return true;
        }else{
            throw new Exception("出错，请检查是否重复", 503);
        }
    }

    public function getActivity(){
        $jwt = $this->checkJwt();

        if($jwt['admin'] == false){
            throw new Exception('无权限', 403);
        }

        if($jwt['admin']->level == 1){//院级管理员
            if(!$this->Act->judge($jwt['admin']->yuan, $this->aid)){
                throw new Exception("无权限", 403);
            }
        }
   
        $re = $this->Act->adminDetail($this->aid);
        return $re;
    }

    /**
     * 获取所有活动举办者
     *
     * @return void
     */
    public function allHoster(){
        $re = $this->Act->allHoster();
        return $re;
    }

    /**
     * 获取所有的活动类型
     *
     * @return void
     */
    public function allType(){
        $re = $this->Act->allType();
        return $re;
    }

    private function checkJwt(){
        $re = $this->User->decode($this->jwt);
        if(isset($re['ret']) && $re['ret'] == 401){
            throw new Exception($re['msg'], 401);
        }
        return $re;
    }
 /**
     * 绑定新用户
     * 
     * @return void
     */
    public function bindUser(){//绑定用户
        $ded = $this->Ded->verify($this->stuid, $this->passwd);
        if($ded === false){
            throw new Exception('密码错误', 403);
        }else{
           $re= $this->User->bindUser($this->stuid,$ded);
           if($re)
           {
            throw new Exception('成功', 100);
           }else{
            throw new Exception('失败', 403);
           }
        }
    }
/**
 * 生成测试使用的jwt
 *
 * @return void
 */
    public function makejwt(){
        //return $this->User->encode('seiry', '031630226', ['level' => 1, 'yuan' => 3]);
        return $this->User->encode('seiry', '031630226', ['level' => 3]);
    }
}
