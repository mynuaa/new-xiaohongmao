<?php
namespace App\Domain;

//use App\Model\Examples\CURD as ModelCURD;
use App\Model\Activity as MActivity;

use function \PhalApi\DI as di;

class Activity {

    function __construct() {
        $this->Act = new MActivity();
    }


    public function gets($from = 0, $num = 20){
        return $this->Act->gets($from, $num);
    }
}
