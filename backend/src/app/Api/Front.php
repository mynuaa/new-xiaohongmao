<?php
namespace App\Api;

use PhalApi\Api;
use PhalApi\Exception;
use PhalApi\Exception\BadRequestException;

use function \PhalApi\DI as di;

use App\Domain\Front as DFront;
use App\Domain\GTCode as DGTCode;
use App\Domain\Ded as DDed;

/**
 * 默认接口服务类
 *
 * @author: dogstar <chanzonghuang@gmail.com> 2014-10-04
 */

class Front extends Api {

    function __construct() {
        $this->Front = new DFront();
        $this->GTCode = new DGTCode();
        $this->Ded = new DDed();
    }
	public function getRules() {
        return [
            'index' => [
                'username' 	=> [
                    'name' => 'username', 
                    'default' => 'PhalApi', 
                    'desc' => '用户名'
                ],
            ],
            'login' => [
                'username' 	=> [
                    'name' => 'username', 
                    'default' => 'PhalApi', 
                    'desc' => '用户名'
                ],
            ],
        ];
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
    
    public function login(){
        return $this->Ded->verify(0,0);
    }
}
