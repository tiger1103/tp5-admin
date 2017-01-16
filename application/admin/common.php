<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2016/12/27
 * Time: 10:27
 */


/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function data_auth_sign($data) {
    //数据类型检测
    if (!is_array($data)) {
        $data = (array) $data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}


/**
 * 判断是否登录
 * @return int
 */
function isLogin(){
    $admin = session('user_auth');
    if (empty($admin)) {
        return 0;
    } else {
        return session('user_auth_sign') == data_auth_sign($admin) ? $admin['id'] : 0;
    }
}

if (!function_exists('format_time')) {
    /**
     * 时间戳格式化
     * @param null $time
     * @param string $format
     * @return false|string
     */
    function format_time($time = null, $format='Y-m-d H:i') {
        $time = $time === null ? time() : intval($time);
        return date($format, $time);
    }
}


