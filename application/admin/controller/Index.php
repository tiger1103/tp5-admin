<?php
namespace app\admin\controller;

/*
 * 后台默认控制器
 */
use think\Controller;
use think\Request;
use think\Response;

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
        if(Request::instance()->isPost()){
            $data = ['status'=>1,'mess'=>'登陆成功。正在跳转到系统后台首页...'];//返回数据
            $captcha = Request::instance()->post('captcha');
            if(!captcha_check($captcha, "adminLogin", config('captcha_config'))){
                $data = ['status'=>0,'mess'=>'验证码输入错误'];
            }
            return Response::create($data, 'json',200,[],[]);
        }
        return $this->fetch();
    }

    public function getCaptcheUrl(){
        return captcha("adminLogin", config('captcha_config'));
    }
}