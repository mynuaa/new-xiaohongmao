<?php
require_once './pass.php';

$re = $old->select('activities', [
    '[>]activite_group' => ['act_group_id']
], [
    'aid',
    'hoster',
    'group_name',
    'type',
    'place(location)',
    'time_last(volunteertimemin)',
    'time_last(volunteertimemax)',
    'title',
    'title(summary)',
    'content(detail)',
    'update(lastupdate)',
    'time_beg(starttime)',
]);

function changeHoster($old){
    switch($old){
        case 1:
            return 0;
        case 6:
            return 2;
        case 7:
            return 3;
        case 9:
            return 5;
        case 11:
            return 7;
        case 12:
            return 8;
        case 13:
            return 9;
        case 14:
            return 10;
        case 16:
            return 12;
        case 17:
            return 15;
        case 19:
            return 1;
        case 21:
            return 16;
        case 23:
            return 4;
        case 24:
            return 6;
        case 25:
            return 101;
        case 26:
            return 102;
        case 27:
            return 11;
        case 26:
            return 103;
    }
}

foreach ($re as $v) {
    $v['hoster'] = changeHoster($v['hoster']);
    if($v['hoster'] == 0){
        $v['level'] = 1;
    }else{
        $v['level'] = 0;
    }
    $v['peoplenum'] = 10;
    $v['alltime'] = $v['peoplenum'] * $v['volunteertimemin'];
    $v['contact'] = 'qq 2269871810 微信公众号 nuaazfj';

    $new->insert('activity',$v);
    if($new->error()[0] != 0){
        var_dump($new->error()[2]);
    }
}

echo 0;
