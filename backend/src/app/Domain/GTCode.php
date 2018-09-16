<?php
namespace App\Domain;

class GTCode {
    public function getRules() {
        return [
            'startCaptchaServlet' => [
                'userId' => [
                    'name' => 'user_id', 
                    'type' => 'string', 
                    'require' => false, 
                    'default' => 'test',
                    'desc' => '用户ID'
                ],
                'clientType' => [
                    'name' => 'client_type', 
                    'type' => 'enum', 
                    'require' => false, 
                    'default' => 'web', 
                    'range' => array('web','h5','native'), 
                    'desc' => 'web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式'
                ]
            ],
            'verifyLoginServlet' => array(
                'userId' => [
                    'name' => 'user_id', 
                    'type' => 'string',
                    'require' => false, 
                    'default' => 'test', 
                    'desc' => '用户ID'
                ],
                'clientType' => [
                    'name' => 'client_type', 
                    'type' => 'enum', 
                    'require' => false, 
                    'default' => 'web', 
                    'range' => array('web','h5','native'), 
                    'desc' => 'web:电脑上的浏览器；h5:手机上的浏览器，包括移动应用内完全内置的web_view；native：通过原生SDK植入APP应用的方式'
                ],
                'challenge' => [
                    'name' => 'challenge', 
                    'type' => 'string', 
                    'require' => true, 
                    'desc' => 'challenge'
                ],
                'validate' => [
                    'name' => 'validate', 
                    'type' => 'string', 
                    'require' => true, 
                    'desc' => 'validate'
                ],
                'seccode' => [
                    'name' => 'seccode', 
                    'type' => 'string', 
                    'require' => true, 
                    'desc' => 'seccode'
                ],
            ),
        ];
    }

    /**
     * 初始化验证
     * @desc 初始化验证
     * @return int success success
     * @return string gt 验证 id，极验后台申请得到
     * @return string challenge 验证流水号，后服务端 SDK 向极验服务器申请得到
     * @return int new_captcha 宕机情况下使用，表示验证是 3.0 还是 2.0，3.0 的 sdk 该字段为 true
     */
    public function startCaptchaServlet($uid, $type = 'web') {
        return \PhalApi\DI()->gtcode->startCaptchaServlet([
            'user_id' => $uid,
            'client_type' => $type,
            'ip_address' => $_SERVER["REMOTE_ADDR"]
        ]);
    }

    /**
     * 二次验证
     * @desc 二次验证
     * @return int code 验证的结果，1表示成功，0表示失败
     */
    public function verifyLoginServlet($challenge, $validate, $seccode, $uid) {

        $code = \PhalApi\DI()->gtcode->verifyLoginServlet($challenge, $validate, $seccode, [
            'user_id' => $uid,
            'client_type' => 'web',
            'ip_address' => $_SERVER["REMOTE_ADDR"]
        ]);

        return $code;
    }

}
