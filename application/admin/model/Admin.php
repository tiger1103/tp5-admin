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
    /**
     * @var string 表名
     */
    protected $table = '__ADMIN_ADMIN__';

    /**
     * @var bool 时间戳自动写入
     */
    protected $autoWriteTimestamp = true;
    // 定义时间戳字段名
    protected $createTime = 'create_time';
    protected $updateTime = false;
    /**
     * 状态属性修改器
     * @param $value
     * @return int
     */
    protected function setStatusAttr($value){
        if($value=='on')
            return 1;
        return 0;
    }



    /**
     * 关联用户组信息
     * @return $this
     */
    public function authGroupAccess(){
        return $this->belongsToMany('AdminAuthGroup','__ADMIN_AUTH_GROUP_ACCESS__','group_id','uid');
    }

    public function authGroup(){
        return $this->hasMany('AuthGroupAccess','uid','id')->field('uid,group_id');
    }


    /**
     * 用户登录
     * @param $map
     * @param $password
     * @return array
     */
    public function login($map,$password){
        $res = $this->where($map)->find();
        if(is_null($res)||$res['status']==0){
            $data = ['status'=>-1,'mess'=>'用户名不存在或被禁用'];//用户名不存在或被禁用
            $this->updateLog($map['username'],0); //更新用户登录信息
            return $data;
        }
        //验证密码是否相等
        if(encypt_password($password,$res['salt']) === $res['password']){
            $data = ['status'=>$res['id'],'mess'=>'登录成功,正在跳转后台首页...']; //登录成功，返回用户ID
            $this->updateLog($map['username'],1); //更新用户登录信息
            /* 记录登录SESSION */
            $auth = array(
                'id'                   => $res['id'],
                'username'        => $res['username'],
                'nickname'         =>$res['nickname']
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

    /**
     * 获取管理员列表数据
     * @param array $map
     * @param string $order
     * @param string field
     * @return \think\paginator\Collection
     */
    public function getAll($map=[],$order='',$field='*'){
        $data_list = self::where($map)->field($field)->order($order)->paginate();
        return $data_list;
    }
}