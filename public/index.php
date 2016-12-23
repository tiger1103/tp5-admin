<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

// [ 应用入口文件 ]
if(version_compare(PHP_VERSION,'5.4.0','<'))  die('require PHP > 5.4.0 !');

define('BASE_PATH', __DIR__);
// 定义应用目录
define('APP_PATH', __DIR__ . '/../application/');
//定义项目URL根路径
define('BASE_URL_PATH', substr($_SERVER['SCRIPT_NAME'], 0, strrpos($_SERVER['SCRIPT_NAME'],'/')));
//定义项目默认模块
defined('DEFAULT_MODULE') or define('DEFAULT_MODULE','index');

// 加载框架引导文件
require __DIR__ . '/../core/start.php';
