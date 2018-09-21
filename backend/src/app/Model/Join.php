<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Join{

    private $col = [
        'join.jid',
        'join.aid',
        'join.timelong',
        'join.status',
        'activity.title',
        'activity.level',
        'activity.hoster',
        'hoster.hostname',
        'hoster.hostnickname'
    ];
    
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
    
    public function getByStuid($stuid){

        $re= di()->db->select('join', [
            '[>]activity' => 'aid',
            '[>]hoster' => ['activity.hoster' => 'hid']
        ], $this->col, [
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
            $con['status'] = 1;
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

    public function getByAid($aid){
        $re = di()->db->select('join', '*', [
            'aid' => $aid
        ]);
        return $re;  
    }

    public function get($jid){
        $re = di()->db->get('join', '*', [
            'jid' => $jid
        ]);

        return $re;
    }

    public function updateStatus($jid, $status = 1, $admin = false){
        $con = [
            'status' => $status,
        ];
        if($admin){
            $con = array_merge($con, [
                'optadmin' => $admin,
                'opttime' => di()->db::raw('NOW()'),
            ]);
        }

        $re = di()->db->update('join', $con, [
            'jid' => $jid
        ]);

        if(di()->db->error()[0] == 0){
            return true;
        }else{
            return false;
        }
    }

    public function countByYuan($yuan){
        $yuan = $this->padding2($yuan);

        $re = di()->db->sum('join', 'timelong', [
            'stuid[~]' => "{$yuan}%" //todo 暂时通过学号判断
        ]);
        
        return $re;
    }

    private function padding2($yuan){
        if((int)$yuan < 10){
            return '0' . $yuan;
        }else{
            return (string)$yuan;
        }

    }
}
