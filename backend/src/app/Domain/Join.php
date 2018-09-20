<?php
namespace App\Domain;

use App\Model\Join as MJoin;

use function \PhalApi\DI as di;

class Join {

    function __construct() {
        $this->Join = new MJoin();
    }

    public function getByStuid($stuid){
        $re = $this->Join->getByStuid($stuid);

        return $re;
    }
    public function getTime($id){
        $re['done'] =  (int)$this->Join->getTime($id, true);
        $re['undone'] =  (int)$this->Join->getTime($id, false); //php无法使用短路运算符

        return $re;
    }

    public function countAll(){
        return $this->Join->countAll();
    }

    public function countMonth(){
        return $this->Join->countMonth();
    }

    public function average(){
        return $this->Join->average();
    }
    
    public function add($uid, $aid, $time, $admin){
        return $this->Join->add($uid, $aid, $time, $admin);
    }
}
