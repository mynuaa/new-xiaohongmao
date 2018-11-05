<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Activity{
    private $unionRelation =  [
        '[>]hoster' => ['hoster' => 'hid'],
        '[>]type' => ['type' => 'typeid']
    ];
    private $unionColumn = [
        'activity.aid',
        'activity.location',
        'activity.hoster',
        'activity.title',
        'activity.summary',
        'activity.alltime',
        'activity.contact',
        'activity.status',
        'activity.starttime',
        'activity.endtime',
        'activity.peoplenum',
        'activity.volunteertimemin',
        'activity.volunteertimemax',
        'activity.group_name',
        'activity.level',
        'activity.lastupdate',
        'hoster.hostname',
        'hoster.hostnickname',
        'activity.type',
        'type.typename'
    ];

    public function gets($from, $num, $all = false, $hid = -1){

        $name = "act:multi:{$from}:{$num}:{$hid}:";
        if($all){
            $name .= 'notall';
        }else{
            $name .= 'all';
        }

        $re = di()->redis->get($name);
        if($re){
            return $re;
        }

        $con =  [
            'LIMIT' => [$from, $num],
            'ORDER' => [
                "aid" => "DESC",
            ]
        ];

        if($all === false){
            $con['activity.status[>]'] = 0;
        }

        if($hid != -1){
            $con['hoster'] = $hid;
        }

        $re= di()->db->select('activity', $this->unionRelation, $this->unionColumn, $con);

        di()->redis->set($name, $re);
        return $re;
    }

    public function get($id){
        $name = 'act:' . $id;
        $re = di()->redis->get($name);
        if($re){
            return $re;
        }

        $this->unionColumn[] = 'activity.detail';
        $re= di()->db->get('activity', $this->unionRelation, $this->unionColumn, [
            'aid' => $id,
            'activity.status[>]' => 0
        ]);

        di()->redis->set($name, $re);
        return $re;

    }

    public function getExpireTime($aid){
        $name = 'actExpireTime:' . $aid;
        $re = di()->redis->get($name);
        if($re){
            return $re;
        }
        
        $re = di()->db->get('activity', 'endtime', [
            'aid' => $aid
        ]);

        di()->redis->set($name, $re);
        return $re;
    }


    public function add($args){
        $re = di()->db->insert('activity', [
            'group_name'=>$args->group_name,
            'location' => $args->location,
            'hoster' => $args->hoster,
            'title' => $args->title,
            'summary' => $args->summary,
            'detail' => $args->detail,
            'peoplenum' => $args->peoplenum,
            'alltime' => $args->alltime,
            'contact' => $args->contact,
            'starttime' => $args->starttime,
            'endtime' => $args->endtime,
            'volunteertimemin' => $args->volunteertimemin,
            'volunteertimemax' => $args->volunteertimemax,
            'type' => $args->type,
            'level' => $args->level,
            'optadmin' => $args->optadmin,
            'lastupdate' => time()

        ]);
        

        if(di()->db->error()[0] == 0){
            return di()->db->id();
        }else{
            return false;
        }
    }

    public function update($aid, $args){
        $args = array_merge($args, [
            'lastupdate' => time()
        ]);

        $re=di()->db->update('activity', $args, [
            'aid'=>$aid
        ]);

        if(di()->db->error()[0] == 0){
            return true;
        }else{
            return false;
        }
        return $re;
    }

    public function del($id, $stuid){
        $re = di()->db->update('activity', [
            'status' => 0,
            'optadmin'=> $stuid,
        ], [
            'aid' => $id
        ]);
        $r = di()->db->update('join',[
            'status' => 0,
            /*'timelong'=>0,*/
            'optadmin' => $stuid,
            'opttime' => di()->db::raw('NOW()')
        ],[
            'aid' => $id
        ]);
        if(di()->db->error()[0] == 0){
            return true;
        }else{
            return false;
        }
    }

    public function setStatus($id, $status,$stuid){
        $re = di()->db->update('activity', [
            'status' => $status,
            'optadmin'=>$stuid,
            'lastupdate'=>time()
        ], [
            'aid' => $id
        ]);

        if(di()->db->error()[0] == 0){
            return true;
        }else{
            return false;
        }
    }

    public function judge($user,$aid){
       /* $hoster = di()->db->get('activity', 'hoster',[
            'aid'=>$aid
        ]);
        $hosterYuan=di()->db->get('admin','yuan',[
            'adminid'=>$hoster
        ]);*/

        $hoster = di()->db->get('activity', 'hoster',[
            'aid'=>$aid
        ] );//这里要修改 todo

        if($user == $hoster){
            return true;
        }else{
            return false;
        }
    }

    public function countNum(){
        
        $re = di()->redis->get('act:allNum');
        if($re){
            return $re;
        }

        $re = di()->db->count('activity', [
            'status[>]' => 0
        ]);
        di()->redis->set('act:allNum', $re);
        return $re;
    }
}
