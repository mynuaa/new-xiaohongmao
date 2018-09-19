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


}
