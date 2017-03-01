<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2016/12/26
 * Time: 12:06
 */

namespace app\admin\validate;


use think\Validate;

class Admin extends Validate
{
    //验证规则
    protected $rule = [
        'username'  =>'require|unique:admin_admin|regex:^[a-zA-Z\d_]{1,64}$|token',
        'password'  =>'require',
        'nickname'  =>'require',
        'phone'       =>'require|unique:admin_admin|number',
        'group'   =>'require',
    ];

    //提示信息
    protected $message = array(
        'username.require'    => '用户名不能为空',
        'username.unique'    => '用户名已存在',
        'username.regex'      =>'用户名必须为1-64位字母,下划线或数字组合',
        'password.require'    =>'密码不能为空',
        'nickname.require'    =>'昵称不能为空',
        'phone.require'         =>'手机号码不能为空',
        'phone.unique'         =>'手机号码已经存在',
        'phone.number'        =>'手机号码格式不正确',
        'group'                =>'管理员所属分组不能为空',
    );

     protected $scene = [
        'login'  =>  ['username'=>'require|regex:^[a-zA-Z\d_]{1,64}$'],
         'edit'   => ['username','nickname','phone','group']
    ];
    
}