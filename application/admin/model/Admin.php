<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2016/12/26
 * Time: 11:21
 */

namespace app\admin\model;

use think\Request;
use think\Db;

class Admin extends Base
{
    //模型名称
    protected $name = 'admin_admin';
    /**
     * 用户登录
     * @param $map
     * @param $password
     * @return array
     */
    public function login($map,$password){
        $res = $this->where($map)->find();
        if(is_null($res)||$res->status==0){
            $data = ['status'=>-1,'mess'=>'用户名不存在或被禁用'];//用户名不存在或被禁用
            $this->updateLog($map['username'],0); //更新用户登录信息
            return $data;
        }
        //验证密码是否相等
        if(md5(md5($password).$res->salt) === $res->password){
            $data = ['status'=>$res->id,'mess'=>'登录成功,正在跳转后台首页...']; //登录成功，返回用户ID
            $this->updateLog($map['username'],1); //更新用户登录信息
            /* 记录登录SESSION */
            $auth = array(
                'id'                   => $res->id,
                'username'        => $res->username
            );

            session('user_auth', $auth);
            session('user_auth_sign', data_auth_sign($auth));
            return $data;
        } else {
            $data = ['status'=>-2,'mess'=>'用户名或密码错误']; //密码错误
            $this->updateLog($map['username'],0); //更新用户登录信息
            return $data;
        }
    }

    /**
     * 更新登录日志
     * @param $username
     * @param $status
     * @param $mess
     */
    private function updateLog($username,$status){
       $data = [
           'username' =>$username,
           'logintime' =>time(),
           'loginip'   =>Request::instance()->ip(),
           'status'   =>$status,
           'mess'      =>$status>0?'登陆成功':'登陆失败'
       ];
        Db::name('admin_adminloginlog')->insert($data);
    }
}