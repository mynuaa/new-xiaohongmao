<?php
namespace App\Domain;

//use App\Model\Examples\CURD as ModelCURD;
use App\Model\Ded as MDed;

class Ded {

    function __construct() {
        $this->MDed = new MDed();
    }

    public function verify($id, $passwd){
        $ded = $this->dedLogin($id, $passwd);
        if($ded !== false){
            return $ded;
        }
        $cas = $this->casLogin($id, $passwd);
        if($cas !== false){
            return $cas;
        }
        return false;

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

    //TODO: 研究生登录 参考sso
    private function dedLogin($stuid, $password) {
        //TODO！ 换个接口！
        
        //$password = urlencode($password); 这个接口不支持 特殊符号
        
        $url = "http://ded.nuaa.edu.cn/NetEAn/User/check.asp";
        $post = "user=" . $stuid . "&pwd=" . $password;
        $cookie = @tempnam('/tmp', 'COOKIE_');
        //var_dump($post);
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_POST => 1,
            CURLOPT_POSTFIELDS => $post,
            CURLOPT_COOKIEJAR => $cookie,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => 2 //2s超时
        ]);
        
        curl_exec($curl);
        
        if(curl_errno($curl) != 0){
			return false;
        }
        
        curl_setopt_array($curl, [
            CURLOPT_COOKIEFILE => $cookie,
            CURLOPT_REFERER => 'http://ded.nuaa.edu.cn'
        ]);
        
        $response = curl_exec($curl);
        
        if(curl_errno($curl) != 0){
			return false;
        }
        
        if (strstr($response, 'switch (0){') == false){
            return false;
        }
        
        curl_setopt_array($curl, [
            CURLOPT_URL => 'http://ded.nuaa.edu.cn/netean/com/jbqkcx.asp',
        ]);
        
        $re = curl_exec($curl);
        
        if(curl_errno($curl) != 0){
			return false;
        }
        
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

    private function casLogin($id, $password){
		$id = urlencode($id);
		$password = urlencode($password);
        $url = "http://weixin.nuaa.edu.cn/authapi/?token=5aaf524af486c781cca727a588c5d3bf&username=$id&password=$password";
        
		$curl = curl_init();
		curl_setopt_array($curl, [
			CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_TIMEOUT => 2 //2s超时
		]);

        $response = curl_exec($curl);
        if(curl_errno($curl) != 0){
			return false;
		}
        curl_close($curl);
        

		$response = '{' . $response . '}';
		$response = json_decode($response);

		if($response->code !== 0){
			return false;
		}else{
			return [
                'name' => $response->xm,
                'gender' => '男',
                'idN' => $id
            ];
		}
	}

}
