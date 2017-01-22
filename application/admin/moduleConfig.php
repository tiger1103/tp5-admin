<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/3
 * Time: 10:49
 */

return [
    // 模块信息
    'info' => [
        'name'        => 'admin',
        'title'       => '系统核心',
        'icon'        => '&#xe62e;',
        'icon_color'  => '#3CA6F1',
        'description' => '核心系统',
        'developer'   => '曲靖开发区奇讯科技有限公司',
        'website'     => 'http://www.qjit.cn',
        'version'     => '1.0.1',
    ],
    // 后台菜单及权限节点配置
    'admin_menu' =>[
        '1' => [
            'pid'   => '0',
            'title' => '系统',
            'icon'  => '&#xe62e;',
            'level' => 'system',
            'url'=>'system'
        ],

        '2' => [
            'pid'  => '1',
            'title' => '系统管理',
            'icon' => '&#xe63c;',
            'url'   =>'systemConfig'
        ],
        '3' => [
            'pid'   => '2',
            'title' => '系统设置',
            'icon'  => '',
            'url'   => 'admin/Config/configSet',
        ],
        '4' => [
            'pid'   => '1',
            'title' => '扩展中心',
            'icon'  => '&#xe61f;',
            'url'   =>'extendCenter'
        ],
        '5' => [
            'pid'   => '4',
            'title' => '功能模块',
            'icon'  => '',
            'url'   => 'admin/Module/index',
        ],
        '6' => [
            'pid'   => '5',
            'title' => '安装',
            'icon'  => '',
            'url'   => 'admin/Module/install',
        ],
        '7' => [
            'pid'   => '5',
            'title' => '卸载',
            'icon'  => '',
            'url'   => 'admin/Module/uninstall',
        ],
        '8' => [
            'pid'   => '5',
            'title' => '更新信息',
            'icon'  => '',
            'url'   => 'admin/Module/updateInfo',
        ],
        '9' => [
            'pid'   => '5',
            'title' => '设置状态',
            'icon'  => '',
            'url'   => 'admin/Module/setStatus',
        ],
        '10'=>[
            'pid'   => '2',
            'title' => '配置管理',
            'icon'  => '',
            'url'   => 'admin/Config/index',
        ],
        '11'=>[
            'pid'   => '10',
            'title' => '设置状态',
            'icon'  => '',
            'url'   => 'admin/Config/setStatus',
        ],
        '12'=>[
            'pid'   => '2',
            'title' => '日志管理',
            'icon'  => '',
            'url'   => 'admin/Log/index',
        ],
        '13'=>[
            'pid'   => '12',
            'title' => '日志详情',
            'icon'  => '',
            'url'   => 'admin/Log/details',
        ],
        '14'=>[
            'pid'   => '12',
            'title' => '删除日志',
            'icon'  => '',
            'url'   => 'admin/Log/delete',
        ],
        '15'=>[
            'pid'   => '2',
            'title' => '行为管理',
            'icon'  => '',
            'url'   => 'admin/Action/index',
        ],
        '16'=>[
            'pid'   => '15',
            'title' => '新增行为',
            'icon'  => '',
            'url'   => 'admin/Action/add',
        ],
        '17'=>[
            'pid'   => '15',
            'title' => '行为状态',
            'icon'  => '',
            'url'   => 'admin/Action/setStatus',
        ],
        '18'=>[
            'pid'   => '15',
            'title' => '删除行为',
            'icon'  => '',
            'url'   => 'admin/Action/delete',
        ],
        '19'=>[
            'pid'   => '15',
            'title' => '修改行为',
            'icon'  => '',
            'url'   => 'admin/Action/edit',
        ],
        '20'=>[
            'pid'   => '1',
            'title' => '系统权限',
            'icon'  => '&#xe62b;',
            'url'   => 'roleAccess',
        ],
        '21'=>[
            'pid'   => '20',
            'title' => '管理员管理',
            'icon'  => '',
            'url'   => 'admin/Access/index',
        ],
        '22'=>[
            'pid'   => '20',
            'title' => '用户组管理',
            'icon'  => '',
            'url'   => 'admin/Group/index',
        ],
        '23'=>[
            'pid'   => '22',
            'title' => '添加用户组',
            'icon'  => '',
            'url'   => 'admin/Group/add',
        ],
        '24'=>[
            'pid'   => '22',
            'title' => '修改用户组',
            'icon'  => '',
            'url'   => 'admin/Group/edit',
        ],
        '25'=>[
            'pid'   => '22',
            'title' => '用户组状态设置',
            'icon'  => '',
            'url'   => 'admin/Group/setStatus',
        ],
        '26'=>[
            'pid'   => '22',
            'title' => '删除用户组',
            'icon'  => '',
            'url'   => 'admin/Group/delete',
        ],
        '27'=>[
            'pid'   => '21',
            'title' => '添加员管理',
            'icon'  => '',
            'url'   => 'admin/Access/add',
        ],
        '28'=>[
            'pid'   => '21',
            'title' => '修改员管理',
            'icon'  => '',
            'url'   => 'admin/Access/edit',
        ],
        '29'=>[
            'pid'   => '21',
            'title' => '设置员管理状态',
            'icon'  => '',
            'url'   => 'admin/Access/setStatus',
        ],
        '30'=>[
            'pid'   => '21',
            'title' => '删除员管理',
            'icon'  => '',
            'url'   => 'admin/Access/delete',
        ],
    ],
];