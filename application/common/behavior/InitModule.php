<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/22
 * Time: 10:48
 */

namespace app\common\behavior;


/**
 * 模块初始化配置
 * @package app\common\behavior
 */
class InitModule
{
    public function run(&$params){
        $request = \think\Request::instance();
        $base_url = [
            //公共资源目录
            '__COMMON__' =>BASE_URL_PATH.'/static/common',
            //带模块控制器的基本地址
            '__BASE_URL__'=>$request->baseFile().'?s='.$request->module().'/'.$request->controller()
        ];
        $view_replace_str = array_merge(config('view_replace_str'),$base_url);
        config('view_replace_str',$view_replace_str);
    }

}