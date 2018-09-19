<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Activity{

    public function gets($from, $num, $all = false){
        $con =  [
            'LIMIT' => [$from, $num]
        ];

        if($all === false){
            $con['status[>]'] = 0;
        }
        
        $re= di()->db->select('activity', '*', $con);

        return $re;
    }

    public function get($id){
        $re= di()->db->get('activity', '*', [
            'aid' => $id,
            'status[>]' => 0
        ]);

        return $re;      
    }


    public function add($args){
        $re = di()->db->insert('shop', [
            'name' => $args->name,
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
            'lastupdate' => time()

        ]);
        

        if(di()->db->error()[0] == 0){
            return di()->db->id();
        }else{
            return false;
        }
    }
}
