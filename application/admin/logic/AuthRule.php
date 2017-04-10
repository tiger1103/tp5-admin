<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/4/7
 * Time: 17:08
 */

namespace app\admin\logic;
use app\admin\model\AuthRule as AuthModel;
use think\auth\Auth;

/**
 * 权限检查及判断
 */
class AuthRule extends AuthModel
{
    public function checkAuth($url=''){
        $url = $url?:$this->getUrl();
        $super_group_id = config('SUPER_GROUP_ID');
        $super_admin_id = config('SUPER_ADMIN_ID');
        $no_check_url = array_map ('strtolower',config('NO_CHECK_URL'));
        $group = session('user_auth.group_id');
        //判断如果在超级管理员组的用户不判断权限
        if(!empty($super_group_id)){
            if(!empty(array_intersect($super_group_id,$group))){
                return true;
            }
        }
        //判断是超级管理员的用户不判断权限
        if(!empty($super_admin_id)){
            if(in_array(UID,$super_admin_id)){
                return true;
            }
        }
        //判断不需要检查权限的url
        if(in_array($url,$no_check_url)){
            return true;
        }
        return Auth::instance()->check($url,UID);
    }

    public function getUrl(){
        return strtolower(request()->module().'/'.request()->controller().'/'.request()->action());
    }
}