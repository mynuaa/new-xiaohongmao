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
    
    public function get($stuid){
        $re= di()->db->select('join', [
            '[>]activity' => 'aid'
        ], '*', [
            'stuid' => $stuid
        ]);
        //todo 查询的列补充
        return $re;  
    }

    public function getTime($id, $done = true){
        $con['stuid'] = $id;
        if($done === true){
            $con['status[>]'] = 1;
        }else{
            $con['status'] = 0;
        }
        $re = di()->db->sum('join', 'timelong', $con);

        return $re;
    }

    public function average(){

        $re= di()->db->avg('join', 'timelong', [
            'status[>]' => 1
        ]);

        return $re;        

    }

    public function add($uid, $aid, $time, $opt){
        $re = di()->db->insert('join', [
            'stuid' => $uid,
            'aid' => $aid,
            'timelong' => $time,
            'optadmin' => $opt,
            'opttime' => di()->db::raw('NOW()'),
            'status' => 0

        ]);
        

        if(di()->db->error()[0] == 0){
            return di()->db->id();
        }else{
            return false;
        }
    }
}
