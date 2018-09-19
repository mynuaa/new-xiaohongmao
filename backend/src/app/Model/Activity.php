<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Activity{

    public function gets($from, $num){
        $re= di()->db->select('activity', '*', [
            'LIMIT' => [$from, $num],
        ]);

        return $re;
    }

    public function get($id){
        $re= di()->db->get('activity', '*', [
            'aid' => $id
        ]);

        return $re;      
    }

}
