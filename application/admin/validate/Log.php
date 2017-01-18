<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/18
 * Time: 9:33
 */

namespace app\admin\validate;


use think\Validate;

class Log extends Validate
{
    //验证规则
    protected $rule = [
        'action_id' =>'require',
        'user_id'   =>'require',
        'action_ip' =>'require',
        'model' =>'require',
        'record_id' =>'require',
    ];

    //提示信息
    protected $message = [
        'action_id.require'    => '行为id不能为空',
        'user_id.require'      => '行为用户id不能为空',
        'action_ip.require'  => '行为用户ip不能为空',
        'model.require'    => '模型名不能为空',
        'record_id.require'       => '触发行为的数据id不能为空',
    ];

    //验证场景
    protected $scene = [

    ];

}