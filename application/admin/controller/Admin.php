<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/26
 * Time: 18:05
 */

namespace app\admin\controller;


use think\Controller;

class Admin extends Controller
{
    public function _initialize(){
        
    }

    /**
     * 判断是否登录
     * @return int
     */
    private function isLogin(){
        $user = session('user_auth');
        if (empty($user)) {
            return 0;
        } else {
            return session('user_auth_sign') == data_auth_sign($user) ? $user['uid'] : 0;
        }
    }
}