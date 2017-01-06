<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/6
 * Time: 10:50
 */

namespace app\admin\validate;


use think\Validate;

class Module extends Validate
{
    //验证规则
    protected $rule = [
        'name' =>'require|unique:admin_module',
        'title'   =>'require',
        'description' =>'require',
        'developer' =>'require',
        'version' =>'require',
        'admin_menu' =>'require',
    ];

    //提示信息
    protected $message = [
        'name.require'    => '模块名不能为空',
        'name.unique'    => '模块名已存在',
        'title.require'      => '模块标题不能为空',
        'description.require'  => '模块描述不能为空',
        'developer.require'    => '模块开发者不能为空',
        'version.require'       => '模块版本号不能为空',
        'admin_menu.require' => '模块菜单节点不能为空',
    ];

    //验证场景
    protected $scene = [

    ];



}