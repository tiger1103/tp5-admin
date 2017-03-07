<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/3/7
 * Time: 9:26
 */

namespace app\admin\validate;


use think\Validate;

class Action extends Validate
{
    //验证规则
    protected $rule = [
        'module' => 'require',
        'name' => 'require|regex:^[a-zA-Z_]+$|unique:admin_action',
        'title' => 'require',
        'remark' => 'require|token'
    ];

    //提示信息
    protected $message = array(
        'module' => '所属模块不能为空',
        'name.require' => '行为标识不能为空',
        'name.regex' => '行为标识必须是字母或下划线组成',
        'name.unique' => '行为标识已经存在',
        'title' => '行为名称不能为空',
        'remark' => '行为描述不能为空'
    );
}