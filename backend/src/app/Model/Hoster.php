<?php
namespace App\Model;

use function \PhalApi\DI as di;

class Hoster {

    public function get($hid){
        $re = di()->db->get('hoster', '*', [
            'hid' => $hid
        ]);

        return $re;
    }

    
}
