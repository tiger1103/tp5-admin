<?php
namespace app\admin\controller;

/*
 * 后台默认控制器
 */
use think\Controller;
use think\Loader;
use think\Request;
use think\Response;

class Index extends Admin
{
    public function index(){
        //检查登录
        if(true){
            //跳转到登录页面
            $this->redirect('admin/index/login');
        }
        return '已经登录';
    }

    public function ok(){
        return '后台首页';
    }

    public function login(){
        if($this->request->isPost()){
            $data = [];//返回数据
            $captcha = $this->request->post('captcha');
            if(!captcha_check($captcha, "adminLogin", config('captcha_config'))){
                $data['status'] =0;
                $data['mess']='验证码输入错误';
            }else {
                $admin = Loader::model('Admin');
                $username = $this->request->post('username');
                $password = $this->request->post('password');
                //验证表单数据
                $validate = Loader::validate('Admin');
                $map['username']=$username;
                $result = $validate->scene('login')->check($map);
                if(!$result){
                    $data['status'] =0;
                    $data['mess']=$result->getError();
                }else{
                    $online = $this->request->has('online', 'post');
                    $data = $admin->login(['username' => $username], $password);
                }
            }
            return Response::create($data, 'json',200,[],[]);
        }
        return $this->fetch();
    }

    public function getCaptcheUrl(){
        return captcha("adminLogin", config('captcha_config'));
    }
}