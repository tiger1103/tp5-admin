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
        [
            'title' => '系统',
            'icon'  => '&#xe62e;',
            'level' => 'system',
            'url'=>'system',
            '_child'=>[
                [
                    'title' => '系统管理',
                    'icon' => '&#xe63c;',
                    'url'   =>'systemConfig',
                    '_child' =>[
                        [
                            'title' => '系统设置',
                            'icon'  => '',
                            'url'   => 'admin/Config/configSet',
                        ],
                        [
                            'title' => '配置管理',
                            'icon'  => '',
                            'url'   => 'admin/Config/index',
                            '_child'=>[
                                [
                                    'title' => '设置状态',
                                    'icon'  => '',
                                    'url'   => 'admin/Module/setStatus',
                                ]
                            ]
                        ],
                        [
                            'title' => '日志管理',
                            'icon'  => '',
                            'url'   => 'admin/Log/index',
                            '_child'=>[
                                [
                                    'title' => '日志详情',
                                    'icon'  => '',
                                    'url'   => 'admin/Log/details',
                                ],
                                [
                                    'title' => '删除日志',
                                    'icon'  => '',
                                    'url'   => 'admin/Log/delete',
                                ],
                            ]
                        ],
                        [
                            'title' => '行为管理',
                            'icon'  => '',
                            'url'   => 'admin/Action/index',
                            '_child'=>[
                                [
                                    'title' => '新增行为',
                                    'icon'  => '',
                                    'url'   => 'admin/Action/add',
                                ],
                                [
                                    'title' => '设置状态',
                                    'icon'  => '',
                                    'url'   => 'admin/Action/setStatus',
                                ],
                                [
                                    'title' => '删除行为',
                                    'icon'  => '',
                                    'url'   => 'admin/Action/delete',
                                ],
                                [
                                    'title' => '修改行为',
                                    'icon'  => '',
                                    'url'   => 'admin/Action/edit',
                                ],
                            ]
                        ],
                        [
                            'title' => '登录日志',
                            'icon'  => '',
                            'url'   => 'admin/LoginLog/index',
                            '_child'=>[
                                [
                                    'title' => '删除日志',
                                    'icon'  => '',
                                    'url'   => 'admin/LoginLog/delete',
                                ]
                            ]
                        ],
                    ]
                ],
                [
                    'title' => '扩展中心',
                    'icon'  => '&#xe61f;',
                    'url'   =>'extendCenter',
                    '_child' => [
                        [
                            'title' => '功能模块',
                            'icon'  => '',
                            'url'   => 'admin/Module/index',
                            '_child' => [
                                [
                                    'title' => '安装',
                                    'icon'  => '',
                                    'url'   => 'admin/Module/install',
                                ],
                                [
                                    'title' => '卸载',
                                    'icon'  => '',
                                    'url'   => 'admin/Module/uninstall',
                                ],
                                [
                                    'title' => '更新信息',
                                    'icon'  => '',
                                    'url'   => 'admin/Module/updateInfo',
                                ],
                                [
                                    'title' => '设置状态',
                                    'icon'  => '',
                                    'url'   => 'admin/Module/setStatus',
                                ],
                            ]
                        ],

                    ]
                ],
                [
                    'title' => '系统权限',
                    'icon'  => '&#xe62b;',
                    'url'   => 'roleAccess',
                    '_child' =>[
                        [
                            'title' => '管理员管理',
                            'icon'  => '',
                            'url'   => 'admin/Manager/index',
                            '_child' =>[
                                [
                                    'title' => '添加员管理',
                                    'icon'  => '',
                                    'url'   => 'admin/Manager/add',
                                ],
                                [
                                    'title' => '修改员管理',
                                    'icon'  => '',
                                    'url'   => 'admin/Manager/edit',
                                ],
                                [
                                    'title' => '设置员管理状态',
                                    'icon'  => '',
                                    'url'   => 'admin/Manager/setStatus',
                                ],
                                [
                                    'title' => '删除管理员',
                                    'icon'  => '',
                                    'url'   => 'admin/Manager/delete',
                                ],
                            ],
                        ],
                        [
                            'title' => '用户组管理',
                            'icon'  => '',
                            'url'   => 'admin/Group/index',
                            '_child' =>[
                                [
                                    'title' => '添加用户组',
                                    'icon'  => '',
                                    'url'   => 'admin/Group/add',
                                ],
                                [
                                    'title' => '修改用户组',
                                    'icon'  => '',
                                    'url'   => 'admin/Group/edit',
                                ],
                                [
                                    'title' => '用户组状态设置',
                                    'icon'  => '',
                                    'url'   => 'admin/Group/setStatus',
                                ],
                                [
                                    'title' => '删除用户组',
                                    'icon'  => '',
                                    'url'   => 'admin/Group/delete',
                                ],
                            ]
                        ]
                    ]
                ],
            ]
         ]
    ],
];