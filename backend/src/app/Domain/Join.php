<?php
namespace App\Domain;

//use App\Model\Examples\CURD as ModelCURD;
use App\Model\Join as MJoin;

use function \PhalApi\DI as di;

class Join {

    function __construct() {
        $this->Join = new MJoin();
    }

    public function countAll(){
        return $this->Join->countAll();
    }

    public function countMonth(){
        return $this->Join->countMonth();
    }
    
}
