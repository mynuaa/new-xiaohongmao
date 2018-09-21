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
 * 用户后台
 *
 * @author: Seiry Yu
 */

class User extends Api {

	public function getRules() {
        return [
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

    public function getInfo(){
        $re = $this->checkJwt();
        $stuid = $re['stuid'];
        $info = $this->User->getInfo($stuid);
        if(!$info){//status不好的处理？
            throw new Exception('error 没有数据', 503);
        }
        return $info;
    }

    public function getJoin(){
        $re = $this->checkJwt();
        $stuid = $re['stuid'];
        $join = $this->Join->getByStuid($stuid);

        return $join;
    }

    private function checkJwt(){
        $re = $this->User->decode($this->jwt);
        if(isset($re['ret']) && $re['ret'] == 401){
            throw new Exception($re['msg'], 401);
        }
        return $re;
    }
}
