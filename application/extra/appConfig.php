<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/4
 * Time: 16:45
 */

return [
    //后台公共模板
    'ADMIN_BASE_LAYOUT' => APP_PATH.'admin/view/public/base.html',

    //缓存标签
    'CACHE_TAG' => [
        'ADMIN_MENU' => ['admin_menu','后台菜单缓存'],
        'AUTH_GROUP' => ['auth_group','用户组缓存'],
        'ADMIN_MODULES' => ['admin_modules','模块名称及标题缓存'],
        'ADMIN_ADMIN' => ['admin_admin','用户昵称缓存'],
        'ADMIN_CONFIG' => ['admin_config','系统配置缓存']
    ]
];