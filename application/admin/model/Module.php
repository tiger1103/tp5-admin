<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/3
 * Time: 14:46
 */

namespace app\admin\model;



class Module extends Base
{
    //模型名称
    protected $name = 'admin_module';

    /**
     * 获取模块列表
     * @return array
     */
    public function getAll($moduleId=1) {
        // 获取除了Common等系统模块外的用户模块
        // 文件夹下必须有$install_file定义的安装描述文件
        $dirs = array_map('basename', glob(APP_PATH.'*', GLOB_ONLYDIR));
        $module_dir_list = [];
        $module_list = [];
        foreach ($dirs as $dir) {
            $config_file = realpath(APP_PATH.$dir).'/'.$this->install_file();
            if (is_file($config_file)) {
                $module_dir_list[] = $dir;
                $temp_arr = include $config_file;
                $temp_arr['info']['status'] = -1; //未安装
                $module_list[$temp_arr['info']['name']] = $temp_arr['info'];
            }
        }
        // 获取系统已经安装的模块信息
        $installed_module_list = $this->field(true)
            ->order('sort asc,id asc')
            ->select();
        if ($installed_module_list) {
            $new_module_list = [];
            foreach ($installed_module_list as &$module) {
                $module = $module->toArray();//数据对象转为数组
                $new_module_list[$module['name']] = $module;
                $new_module_list[$module['name']]['admin_menu'] = json_decode($module['admin_menu'], true);
            }
            // 系统已经安装的模块信息与文件夹下模块信息合并
            $module_list = array_merge($module_list, $new_module_list);
        }
        foreach ($module_list as &$val) {
            switch($val['status']){
                case '-2':  // 损坏
                    $val['status_icon'] = '<i class="Hui-iconfont">&#xe613;</i> 删除记录';
                    $val['right_button']['damaged']['title'] = '删除记录';
                    $val['right_button']['damaged']['attribute'] = 'class="label label-danger ajax-get" href="'.url('setStatus', array('status' => 'delete', 'ids' => $val['id'])).'"';
                    break;
                case '-1':  // 未安装
                    $val['status_icon'] = '<i class="fa fa-download text-success"></i>';
                    $val['right_button']['install_before']['title'] = '安装';
                    $val['right_button']['install_before']['attribute'] = 'class="label label-success" href="'.url('install_before', array('name' => $val['name'])).'"';
                    break;
                case '0':  // 禁用
                    $val['status_icon'] = '<i class="fa fa-ban text-danger"></i>';
                    $val['right_button']['update_info']['title'] = '更新菜单';
                    $val['right_button']['update_info']['attribute'] = 'class="label label-info ajax-get" href="'.url('updateInfo', array('id' => $val['id'])).'"';
                    $val['right_button']['forbid']['title'] = '启用';
                    $val['right_button']['forbid']['attribute'] = 'class="label label-success ajax-get" href="'.url('setStatus', array('status' => 'resume', 'ids' => $val['id'])).'"';
                    $val['right_button']['uninstall_before']['title'] = '卸载';
                    $val['right_button']['uninstall_before']['attribute'] = 'class="label label-danger" href="'.url('uninstall_before', array('id' => $val['id'])).'"';
                    break;
                case '1':  // 正常
                    $val['status_icon'] = '<i class="fa fa-check text-success"></i>';
                    $val['right_button']['update_info']['title'] = '更新菜单';
                    $val['right_button']['update_info']['attribute'] = 'class="label label-info ajax-get" href="'.url('updateInfo', array('id' => $val['id'])).'"';
                    if (!$val['is_system']) {
                        $val['right_button']['forbid']['title'] = '禁用';
                        $val['right_button']['forbid']['attribute'] = 'class="label label-warning ajax-get" href="'.url('setStatus', array('status' => 'forbid', 'ids' => $val['id'])).'"';
                        $val['right_button']['uninstall_before']['title'] = '卸载';
                        $val['right_button']['uninstall_before']['attribute'] = 'class="label label-danger" href="'.url('uninstall_before', array('id' => $val['id'])).'"';
                    }
                    break;
            }
        }
        return $module_list;
    }

    /**
     * 安装描述文件名
     * @return String
     */
    private function install_file() {
        return 'moduleConfig.php';
    }
}