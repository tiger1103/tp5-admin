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
        'title'       => '系统',
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
        ],

        '2' => [
            'pid'   => '1',
            'title' => '系统管理',
            'icon'  => '&#xe62e;',
        ],
        '3' => [
            'pid'   => '2',
            'title' => '系统设置',
            'icon'  => '',
            'url'   => 'admin/Config/group',
        ],
        '4' => [
            'pid'   => '1',
            'title' => '扩展中心',
            'icon'  => '&#xe61f;',
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
            'url'   => 'admin/Module/install',
        ],
        '7' => [
            'pid'   => '5',
            'title' => '卸载',
            'url'   => 'admin/Module/uninstall',
        ],
        '8' => [
            'pid'   => '5',
            'title' => '更新信息',
            'url'   => 'admin/Module/updateInfo',
        ],
        '9' => [
            'pid'   => '5',
            'title' => '设置状态',
            'url'   => 'admin/Module/setStatus',
        ],
    ],

];