<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/3
 * Time: 14:46
 */

namespace app\admin\model;
use util\Tree;

class Module extends Base
{
    /**
     * @var string 表名
     */
    protected $table = '__ADMIN_MODULE__';

    /**
     * 获取模块列表
     * @param int moduleId 模块id
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
        $installed_module_list = $this->order('sort asc,id asc')->column(true);
        if (!empty($installed_module_list)) {
            $new_module_list = [];
            foreach ($installed_module_list as $module) {
                $new_module_list[$module['name']] = $module;
                $new_module_list[$module['name']]['admin_menu'] = json_decode($module['admin_menu'], true);
            }
            // 系统已经安装的模块信息与文件夹下模块信息合并
            $module_list = array_merge($module_list, $new_module_list);
        }
        foreach ($module_list as &$val) {
            switch($val['status']){
                case '-2':  // 损坏
                    $val['status'] = '<span class="label label-danger radius">已损坏</span>';
                    break;
                case '-1':  // 未安装
                    $val['status'] = '<span class="label label-primary radius">安装</span>';
                    break;
                case '0':  // 禁用
                    $val['status'] = '<span class="label label-warning radius">已禁用</span>';
                    break;
                case '1':  // 正常
                    $val['status'] = '<span class="label label-success radius">已启用</span>';
                    break;
            }
        }
        return $module_list;
    }    

    /**
     * 安装描述文件名
     * @return String
     */
    public function install_file() {
        return 'moduleConfig.php';
    }

    /**
     * 获取所有模块菜单
     */
    public function getAllMenu() {
        $menu_list = cache('MENU_LIST');
        if (!$menu_list || config('APP_DEBUG') === true) {
            $con['status'] = 1;
            $system_module_list = $this->where($con)->order('sort asc, id asc')->column(true);
            $tree = new tree();
            $menu_list = array();
            foreach ($system_module_list as $key => &$module) {
                $temp = $tree->list_to_tree(json_decode($module['admin_menu'], true));
                $menu_list[$module['name']] = $temp[0];
                $menu_list[$module['name']]['id']   = $module['id'];
                $menu_list[$module['name']]['name'] = $module['name'];
            }
            // 如果模块顶级菜单配置了top字段则移动菜单至top所指的模块下边
            foreach ($menu_list as $key => &$value) {
                if (isset($value['top'])&&!empty($value['top'])) {
                    if ($menu_list[$value['top']]) {
                        $menu_list[$value['top']]['_child'] = array_merge(
                            $menu_list[$value['top']]['_child'],
                            $value['_child']
                        );
                        unset($menu_list[$key]);
                    }
                }
            }
            cache('MENU_LIST', $menu_list, null,get_cache_tag('admin_menu'));  // 缓存配置
        }
        return $menu_list;
    }

    /**
     * 获取所有模块的名称和标题
     * @return mixed
     */
    public static function getModule()
    {
        $modules = cache('modules');
        if (!$modules) {
            $modules = self::where('status', '>=', 0)->order('id')->column('name,title');
            // 非开发模式，缓存数据
            if (config('develop_mode') == 0) {
                cache('modules', $modules,null,get_cache_tag('admin_modules'));
            }
        }
        return $modules;
    }
}