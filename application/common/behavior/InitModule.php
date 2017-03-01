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
        //获取模块配置
        $module_config = cache('module_config');
        if(!$module_config || config('APP_DEBUG') === true){
            $request = \think\Request::instance();
            $module_config = config();
            $base_url = [
                //公共资源目录
                '__COMMON__' =>BASE_URL_PATH.'/static/common',
                //带模块控制器的基本地址
                '__BASE_URL__'=>$request->baseFile().'?s='.$request->module().'/'.$request->controller()
            ];
            $module_config['view_replace_str'] = array_merge($module_config['view_replace_str'],$base_url);
            //定义session存储路径
            $session_path = RUNTIME_PATH.'session';
            //判断session存储路径是否已经存在，不存在则创建之
            if(!is_dir($session_path)){
                $this->createSessionDir($session_path);
            }
            $module_config['session']['path'] = '2;'.$session_path;
            //缓存配置
            cache('module_config',$module_config,null,get_cache_tag('admin_config'));
        }
        //新配置
        config($module_config);
    }

    /**
     * @param string $session_path session存储主路径
     * 创建session保存路径
     */
    private function createSessionDir($session_path){
        $dir = "0123456789abcdefghijklmnopqrstuvwsyz";
        for($i =0;$i<strlen($dir);$i++){
            for($j=0;$j<strlen($dir);$j++){
                $dir_name = $session_path.DS.$dir[$i].DS.$dir[$j];
                if(!file_exists($dir_name)){
                    mkdir($dir_name,0777,true);
                }
            }
        }
    }

}