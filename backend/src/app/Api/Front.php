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
 * 前端接口
 *
 * @author: Seiry Yu
 */

class Front extends Api {


	public function getRules() {
        return [
            'index' => [
                'username' => [
                    'name' => 'username', 
                    'default' => 'PhalApi', 
                    'desc' => '用户名'
                ],
            ],
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
                ],
                'hid' => [
                    'name' => 'hid', 
                    'desc' => 'hosterid',
                    'type' => 'int',
                    'require' => false,
                    'default' => -1, 

                ]
            ],
            'getActivity' => [
                'id' => [
                    'name' => 'id', 
                    'desc' => '活动id',
                    'type' => 'int',
                    'require' => true,
                ]
            ],
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
	 * 默认接口服务
     * @desc 默认接口服务，当未指定接口服务时执行此接口服务
	 * @return string title 标题
	 * @return string content 内容
	 * @return string version 版本，格式：X.X.X
	 * @return int time 当前时间戳
     * @exception 400 非法请求，参数传递错误
	 */
	public function index() {
        return $this->Front->index();
        return [
            'title' => 'Hello ' . $this->username,
            'version' => PHALAPI_VERSION,
            'time' => $_SERVER['REQUEST_TIME'],
        ];
    }

    /**
     * 获取所有志愿活动
     *
     * @return void
     */
    public function allActivity(){
        
        $re = $this->Act->gets($this->from, $this->pagenum, false, $hid);

        return $re;
    }

    /**
     * 按id获取活动
     *
     * @return void
     */
    public function getActivity(){
        $re = $this->Act->get($this->id);

        return $re;
    }


    /**
     * 获取用于展示的数据
     *
     * @return array
     */
    public function showData(){
        $re = [];
        $re['allTimeLong'] = $this->Join->countAll();
        $re['mouthLong'] = $this->Join->countMonth();
        $re['allUser'] = $this->User->countAll();
        $re['averageTimeLong'] = $this->Join->average();

        $yuan = [];
        for ($i=1; $i < 17; $i++) { 
            $yuan[$i] = $this->Join->countByYuan($i);
        }
        
        $re['yuan'] = $yuan;
        return $re;
    }

}
