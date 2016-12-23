<?php
namespace app\admin\controller;

/*
 * 后台默认控制器
 */
use think\Controller;

class Index extends Controller
{
    public function index(){
        //检查登录
        if(true){
            //跳转到登录页面
            $this->redirect('admin/index/login');
        }
        return '已经登录';
    }

    public function login(){
        return $this->fetch();
    }

    public function test(){
        return captcha('adminLogin',config('captcha_config'));
    }
}