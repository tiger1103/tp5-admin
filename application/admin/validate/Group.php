<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/19
 * Time: 17:07
 */

namespace app\admin\validate;


use think\Validate;

class Group extends Validate
{
    //验证规则
    protected $rule = [
        'pid' =>'require|integer',
        'title'   =>'require',
        'sort'  =>'number|token',
    ];

    //提示信息
    protected $message = [
        'pid.require'    => '所属用户组不能为空',
        'pid.integer'    => '所属用户组pid必须为数字',
        'title.require'      => '用户组名不能为空',
        'sort.number'   =>'排序必须是数字',
    ];

    //验证场景
    protected $scene = [

    ];

}