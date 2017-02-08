<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
if (!function_exists('time_format')) {
    /**
     * 时间戳格式化
     * @param int $time
     * @return string 完整的时间显示
     */
    function time_format($time = NULL, $format = 'Y-m-d H:i')
    {
        $time = $time === NULL ? time() : intval($time);
        return date($format, $time);
    }
}

if (!function_exists('parse_attr')) {
    /**
     * 根据配置类型解析配置
     * @param  string $type 配置类型
     * @param  string $value 配置值
     * @return array
     */
    function parse_attr($value, $type = null)
    {
        switch ($type) {
            default: //解析"1:1\r\n2:3"格式字符串为数组
                $array = preg_split('/[,;\r\n]+/', trim($value, ",;\r\n"));
                if (strpos($value, ':')) {
                    $value = array();
                    foreach ($array as $val) {
                        list($k, $v) = explode(':', $val);
                        $value[$k] = $v;
                    }
                } else {
                    $value = $array;
                }
                break;
        }
        return $value;
    }
}


if (!function_exists('clear_js')) {
    /**
     * 过滤js内容
     * @param string $str 要过滤的字符串
     * @return mixed|string
     */
    function clear_js($str = '')
    {
        $search ="/<script[^>]*?>.*?<\/script>/si";
        $str = preg_replace($search, '', $str);
        return $str;
    }
}

if (!function_exists('get_file_name')) {
    /**
     * 根据附件id获取文件名
     * @param string $id 附件id
     * @return string
     */
    function get_file_name($id = '')
    {
        $name = model('admin/attachment')->getFileName($id);
        if (!$name) {
            return '没有找到文件';
        }
        return $name;
    }
}


if (!function_exists('get_file_path')) {
    /**
     * 获取附件路径
     * @param int $id 附件id
     * @return string
     */
    function get_file_path($id = 0)
    {
        $path = model('admin/attachment')->getFilePath($id);
        if (!$path) {
            return BASE_URL_PATH.'/static/admin/images/none.png';
        }
        return BASE_URL_PATH.'/'. $path;
    }
}


if (!function_exists('get_thumb')) {
    /**
     * 获取图片缩略图路径
     * @param int $id 附件id
     * @return string
     */
    function get_thumb($id = 0)
    {
        $path = model('admin/attachment')->getThumbPath($id);
        if (!$path) {
            return BASE_URL_PATH.'/static/admin/images/none.png';
        }
        return BASE_URL_PATH.'/'. $path;
    }
}