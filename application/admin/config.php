<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2016/12/23
 * Time: 11:22
 */

return [
    //超级管理员组ID
    'SUPER_GROUP_ID'=>[1],
    //超级管理员ID
    'SUPER_ADMIN_ID'=>[1],
    //当前访问模块位置
    'LOCATION'                   =>'admin',
    //默认数据过滤
    'default_filter' => 'trim',
    // 视图输出字符串内容替换
    'view_replace_str' =>[
        '__ADMIN__' => BASE_URL_PATH . '/static/admin',
        '__IMG__'    => BASE_URL_PATH . '/static/admin/images',
        '__CSS__'    => BASE_URL_PATH . '/static/admin/css',
        '__JS__'     => BASE_URL_PATH . '/static/admin/js',
    ],
    //验证码配置
    'captcha_config'=>[
        // 验证码加密密钥
        'seKey'    => 'yixiaohu',
        // 验证码字符集合
        'codeSet'  => '2345678abcdefhjkmnprstuvwxyzABCDEFGHJKLMNPRTUVWXY',
        // 验证码过期时间（s）
        'expire'   => 1800,
        // 验证码字体大小(px)
        'fontSize' => 18,
        // 是否画混淆曲线
        'useCurve' => true,
        // 是否添加杂点
        'useNoise' => true,
        // 验证码图片高度
        'imageH'   => 40,
        // 验证码图片宽度
        'imageW'   => 120,
        // 验证码位数
        'length'   => 4,
        // 验证码字体，不设置随机获取
        'fontttf'  => '6.ttf',
        // 背景颜色
        'bg'       => [243, 251, 254],
        // 验证成功后是否重置
        'reset'    => true,
    ],
    //session配置
    'session'                => [
        'prefix'         => 'admin',
        'type'           => '',
        'auto_start'  => true,
    ],

    //cookie配置
    'cookie'=>[
        // cookie 名称前缀
        'prefix'    => 'admin_',
        // cookie 保存时间
        'expire'    => 0,
        // cookie 保存路径
        'path'      => '/',
        // cookie 有效域名
        'domain'    => '',
        //  cookie 启用安全传输
        'secure'    => false,
        // httponly设置
        'httponly'  => '',
        // 是否使用 setcookie
        'setcookie' => true,
    ],

    // +----------------------------------------------------------------------
    // | 缓存设置
    // +----------------------------------------------------------------------
    'cache'                  => [
        // 驱动方式
        'type'   => 'File',
        // 缓存保存目录
        'path'   => CACHE_PATH,
        // 缓存前缀
        'prefix' => 'admin',
        // 缓存有效期 0表示永久缓存
        'expire' => 0,
    ],

    //分页配置
    'paginate'               => [
        'type'      => '\app\admin\driver\HuiPaginnator',
        'var_page'  => 'page',
        'list_rows' => 10,
    ],
    // 最大缓存用户数
    'user_max_cache' => 1000,
];