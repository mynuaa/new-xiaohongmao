<?php
namespace App\Domain;

use App\Model\Activity as MActivity;
use App\Model\Join as MJoin;

use function \PhalApi\DI as di;

class Activity {

    function __construct() {
        $this->Act = new MActivity();
        $this->Join = new MJoin();
    }


    public function gets($from = 0, $num = 20, $all = false){
        return $this->Act->gets($from, $num, $all);
    }

    public function get($id){
        return $this->Act->get($id);
    }

    public function add($args){
        $re = $this->Act->add($args);
        return $re;
    }

    public function adminDetail($aid){
        $re['activity'] =  $this->Act->get($aid);
        $re['join'] = $this->Join->getByAid($aid);

        return $re;
    }

    public function del($id){
        return $this->Act->setStatus($id, 0);
    }
    public function open($id){
        return $this->Act->setStatus($id, 1);
    }
    public function shoutdown($id){
        return $this->Act->setStatus($id, 2);
    }
    public function setStopTime($id, $time){
        return $this->Act->setStatus($id, $time);
    }
}