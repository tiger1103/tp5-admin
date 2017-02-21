<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/3
 * Time: 15:53
 */

namespace app\common\behavior;


class InitConfig
{
    public function run(&$params){
        // 读取缓存配置
        $system_config = cache('DB_CONFIG_DATA');
        if (!$system_config || config('APP_DEBUG') === true) {
            // 获取所有系统配置
            $system_config = model('Admin/Config')->getConfig();
            // 获取所有安装的模块配置
            $module_list = model('Admin/Module')->where('status',1)->column(true);
            $module_config = [];
            foreach ($module_list as $val) {
                $module_config[strtolower($val['name'].'_config')] = json_decode($val['config'], true);
                $module_config[strtolower($val['name'].'_config')]['module_name'] = $val['name'];
            }
            if (!empty($module_config)) {
                // 合并模块配置
                $system_config = array_merge($system_config, $module_config);
            }
            // 加载Formbuilder扩展类型
            $formbuilder_extend = explode(',', model('Admin/Hook')->getFieldByName('FormBuilderExtend', 'addons'));
            if (!empty($formbuilder_extend)){
                $config = model('Admin/Addon')->where(['name'=>['in',$formbuilder_extend]])->column('config');
                foreach ($config as $val) {
                    $temp = json_decode($val, true);
                    if ($temp['status']) {
                        $form_type[$temp['form_item_type_name']] = array($temp['form_item_type_title'], $temp['form_item_type_field']);
                        $system_config['FORM_ITEM_TYPE'] = array_merge($system_config['FORM_ITEM_TYPE'], $form_type);
                    }
                }
            }
            if(defined("SESSION_PATH")){
                $system_config['session']['path'] = '2;'.SESSION_PATH;
            }
            cache('DB_CONFIG_DATA', $system_config,null,get_cache_tag('admin_config'));  // 缓存配置
        }
        config($system_config);
    }
}