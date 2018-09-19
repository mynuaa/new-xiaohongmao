<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Join{

    public function countAll(){
        $re= di()->db->sum('join', 'timelong', [
            'status[>]' => 1
        ]);

        return $re;
    }
    
    /**
     * 月份差
     *
     * @param integer $month 形如'2018-04'
     * @return void
     */
    public function countMonth($month = 0){
        if($month == 0){
            $time = date('Y-m');
        }else{
            $time = $month;
        }

        $time = strtotime($time);
        $re= di()->db->sum('join', 'timelong', [
            'status[>]' => $time,

        ]);
        return $re;
    }

}
