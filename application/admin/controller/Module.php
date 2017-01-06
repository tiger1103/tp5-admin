<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/3
 * Time: 14:38
 */

namespace app\admin\controller;

/**
 * 模块管理
 * Class Module
 * @package app\admin\controller
 */
class Module extends Base
{

    /**
     * 模块管理首页
     * @return mixed
     */
    public function index(){
        $moduleId = $this->request->has('moduleId')?$this->request->get('moduleId'):1;
        $module = model('Module');
        $data_list = $module->getAll($moduleId);
        // 使用Builder快速建立列表页面。
        $builder = new \app\Common\Builder\ListBuilder();
        return $builder->setMetaTitle('模块列表')  // 设置页面标题
            ->setBreadTree(['首页','扩展中心','功能模块'])
            ->addTopButton('resume')   // 添加启用按钮
            ->addTopButton('forbid')   // 添加禁用按钮
            ->setSearch('请输入ID/标题', url('index'))
            ->addTableColumn('name', '名称')
            ->addTableColumn('title', '标题')
            ->addTableColumn('description', '描述')
            ->addTableColumn('developer', '开发者')
            ->addTableColumn('version', '版本')
            ->addTableColumn('create_time', '创建时间', 'time')
            ->addTableColumn('status_icon', '状态', 'text')
            ->addTableColumn('right_button', '操作', 'btn')
            ->setTableDataList($data_list)     // 数据列表
            ->display();
    }

    /**
     * 更新模块信息
     * @param int $id 模块id
     */
    public function updateInfo($id){
        $module = model('Module');
        $name = $module->getFieldById($id, 'name');
        $config_file = realpath(APP_PATH.strtolower($name)).'/'
            .$module->install_file();
        if (!$config_file) {
            $this->result([],0,'不存在安装文件','json');
        }
        $config_info = include $config_file;
        $data = $config_info['info'];
        // 读取数据库已有配置
        $db_moduel_config = $module->getFieldByName($name, 'config');
        $db_moduel_config = json_decode($db_moduel_config, true);

        // 处理模块配置
        if (isset($config_info['config'])&&!empty($config_file['config'])) {
            $temp_arr = $config_info['config'];
            foreach ($temp_arr as $key => $value) {
                if ($value['type'] == 'group') {
                    foreach ($value['options'] as $gkey => $gvalue) {
                        foreach ($gvalue['options'] as $ikey => $ivalue) {
                            $config[$ikey] = $ivalue['value'];
                        }
                    }
                } else {
                    if (isset($db_moduel_config[$key])) {
                        $config[$key] = $db_moduel_config[$key];
                    } else {
                        $config[$key] = $temp_arr[$key]['value'];
                    }
                }
            }
            $data['config'] = json_encode($config);
        } else {
            $data['config'] = '';
        }

        // 获取后台菜单
        if (isset($config_info['admin_menu'])&&!empty($config_info['admin_menu'])) {
            // 将key值赋给id
            foreach ($config_info['admin_menu'] as $key => &$val) {
                $val['id'] = (string)$key;
            }
            $data['admin_menu'] = json_encode($config_info['admin_menu']);
        }

        // 获取用户中心导航
        if (isset($config_info['user_nav'])&&!empty($config_info['user_nav'])) {
            $data['user_nav'] = json_encode($config_info['user_nav']);
        } else {
            $data['user_nav'] = '';
        }
        $data['id'] = $id;
        if(false===$module->allowField(true)->validate('Module')->isUpdate(true)->save($data)){
            $this->result([],0,$module->getError(),'json');
        }else{
            $this->result([],1,'更新成功','json');
        }
    }
}