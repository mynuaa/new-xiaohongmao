<?php
namespace App\Domain;

//use App\Model\Examples\CURD as ModelCURD;
use App\Model\Ded as MDed;

class Ded {

    function __construct() {
        $this->MDed = new MDed();
    }

    public function verify($id, $passwd){
        return $this->usrverify($id, $passwd);
    }

    public function getInfo(){
        $re['name'] = '于文杰';
        $re['sex'] = 'boy';
        return $re;
    }

    public function binded($stuid){
        if($this->MDed->hasDed($stuid) != ''){//如果取出的学号不为空 即已经绑定
            return true;//返回已经绑定
        }else{
            return false;
        }
    }

    //TODO!! 研究生登录 参考sso
    public function usrverify($stuid, $password) {
        $password = urlencode($password);
        
        $url = "http://ded.nuaa.edu.cn/NetEAn/User/check.asp";
        $post = "user=" . $stuid . "&pwd=" . $password;
        $cookie = @tempnam('/tmp', 'COOKIE_');
        
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_COOKIEJAR => $cookie,
            CURLOPT_RETURNTRANSFER => 1,
        ]);
        
        curl_exec($curl);
        
        curl_setopt_array($curl, [
            CURLOPT_COOKIEFILE => $cookie,
            CURLOPT_REFERER => 'http://ded.nuaa.edu.cn'
        ]);
        
        $response = curl_exec($curl);
        
        
        if (strstr($response, 'switch (0){') == false){
            return false;
        }
        
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://ded.nuaa.edu.cn/netean/com/jbqkcx.asp',
        ]);
        
        $re = curl_exec($curl);
        
        curl_close($curl);
        $re = iconv('GBK', 'UTF-8', $re);
        preg_match('/id\=\"t_xm\"\>(.+)\&/', $re, $name);
        $name = $name[1];
        preg_match('/id\=\"t_xb\"\>(.*)\&/', $re, $gender);
        $gender = $gender[1];
        preg_match('/id\=\"t_sfzh\"\>(.+)\&/', $re, $id);
        $id = $id[1];

        return [
            'name' => $name,
            'gender' => $gender,
            'idN' => $id
        ];
    }

}
