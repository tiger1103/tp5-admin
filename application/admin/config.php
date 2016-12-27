<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2016/12/23
 * Time: 11:22
 */

return [
    //默认数据过滤
    'default_filter' => 'trim',
    // 视图输出字符串内容替换
    'view_replace_str' =>[
        '__PUBLIC__' => BASE_URL_PATH . '/static/admin',
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
        'auto_start'     => true,
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

    //加密类库驱动
    'DATA_CRYPT_TYPE'=>'think',
];