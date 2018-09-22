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
        'activity.detail',
        'activity.alltime',
        'activity.contact',
        'activity.status',
        'activity.starttime',
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

    public function gets($from, $num, $all = false){
        $con =  [
            'LIMIT' => [$from, $num]
        ];

        if($all === false){
            $con['activity.status[>]'] = 0;
        }

        $re= di()->db->select('activity', $this->unionRelation, $this->unionColumn, $con);

        return $re;
    }

    public function get($id){
        $re= di()->db->get('activity', $this->unionRelation, $this->unionColumn, [
            'aid' => $id,
            'activity.status[>]' => 0
        ]);

        return $re;
    }

    public function add($args){
        $re = di()->db->insert('activity', [
            'location' => $args->location,
            'hoster' => $args->hoster,
            'title' => $args->title,
            'summary' => $args->summary,
            'detail' => $args->detail,
            'peoplenum' => $args->peoplenum,
            'alltime' => $args->alltime,
            'contact' => $args->contact,
            'starttime' => $args->starttime,
            'volunteertimemin' => $args->volunteertimemin,
            'volunteertimemax' => $args->volunteertimemax,
            'type' => $args->type,
            'level' => $args->level,
            'lastupdate' => time()

        ]);
        

        if(di()->db->error()[0] == 0){
            return di()->db->id();
        }else{
            return false;
        }
    }
    
    //todo 更新活动
    public function update($args){

    }


    public function setStatus($id, $status){
        $re = di()->db->update('activity', [
            'status' => $status
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
}
