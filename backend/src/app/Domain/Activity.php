<?php
namespace App\Domain;

use App\Model\Activity as MActivity;
use App\Model\Hoster as MHoster;
use App\Model\Type as MType;
use App\Model\Join as MJoin;

use function \PhalApi\DI as di;

class Activity {

    function __construct() {
        $this->Act = new MActivity();
        $this->Join = new MJoin();
        $this->Hoster = new MHoster();
        $this->Type = new MType();
    }


    public function gets($from = 0, $num = 20, $all = false, $hid = -1){
        return $this->Act->gets($from, $num, $all, $hid);
    }

    public function get($id){
        return $this->Act->get($id);
    }

    public function getExpireTime($aid){
        $re = $this->Act->getExpireTime($aid);
        return $re;
    }

    public function add($args){
        $re = $this->Act->add($args);
        return $re;
    }

    public function update($aid, $args){
        return $this->Act->update($aid, $args);
    }

    public function adminDetail($aid){
        $re['activity'] =  $this->Act->get($aid);
        $re['join'] = $this->Join->getByAid($aid);

        return $re;
    }

    public function allHoster(){
        return $this->Hoster->getAll();

    }
    public function allType(){
        return $this->Type->getAll();
    }

    public function countNum(){
        return $this->Act->countNum();
    }

    public function del($id,$stuid){//todo 加判断
        return $this->Act->del($id,$stuid);//add an function to delete an activity
    }
    public function open($id,$stuid){//todo 加判断
        $this->Act->update($id, [
            'endtime' => time() + 60 * 60 * 24 * 7  //-1s
        ]);
        return $this->Act->setStatus($id, 1,$stuid);
    }
    public function shoutdown($id,$stuid){//todo 加判断/***/ */
        $this->Act->update($id, [
            'endtime' => time() - 1 //-1s
        ]);
        return $this->Act->setStatus($id, 2,$stuid);//***** */
    }
    public function setStopTime($id, $time,$stuid){//todo 加判断/////*///***/ */
        return $this->Act->setStatus($id, $time,$stuid);
    }

    public function judge($user,$hoster){//added by helaji//todo 加判断
        return $this->Act->judge($user, $hoster);
    }

    
}
