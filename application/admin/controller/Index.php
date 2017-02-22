<?php
namespace app\admin\controller;

/*
 * 后台默认控制器
 */
use think\Controller;
use think\Loader;
use think\Response;

class Index extends Controller
{
    /**
     * 登录
     * @return mixed|Response|\think\response\Json|\think\response\Jsonp|\think\response\Redirect|\think\response\View|\think\response\Xml|void
     */
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
                    $data['mess']=$validate->getError();
                }else{
                    $online = $this->request->has('online', 'post');
                    $data = $admin->login(['username' => $username], $password);
                    //保持登录状态
                    if($online&&$data['status']>0){
                        cookie(ini_get('session.name'),session_id(),['expire'=>86400*7,'path'=>"/",'prefix'=>'']);
                    }
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
        session(null);//清除session
        $this->success('退出登录成功','index/index');
    }

    /**
     * 获取验证码图片地址
     * @return Response
     */
    public function getCaptcheUrl(){
        return captcha("adminLogin", config('captcha_config'));
    }

}