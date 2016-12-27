<?php
namespace app\admin\controller;

/*
 * 后台默认控制器
 */
use think\Controller;
use think\Cookie;
use think\Loader;
use think\Response;

class Index extends Controller
{
    public function index(){
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
        if(isLogin()>0){
            $this->redirect('admin/index');
            return;
        }
        return $this->fetch();
    }

    /**
     * 退出登录
     */
    public function logout(){
        session('user_auth', null);
        session('user_auth_sign', null);
    }

    public function getCaptcheUrl(){
        return captcha("adminLogin", config('captcha_config'));
    }

}