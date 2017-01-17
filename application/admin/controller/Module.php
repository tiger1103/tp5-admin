<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/3
 * Time: 14:38
 */

namespace app\admin\controller;
use app\common\creater\Instance;

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
        // 使用Creater快速建立列表页面。
        return Instance::getInstance('table','AdminCreater')
            ->setPageTitle('配置管理') // 设置页面标题
            ->setBreadTree(['首页','扩展中心','功能模块'])//设置面包树
            ->setSearch([
                'name'=>['title'=>'名称','type'=>'text','placeholder'=>'请输入名称'],
                'title'=>['title'=>'标题','type'=>'text','placeholder'=>'请输入标题']
            ])//设置搜索
            ->addColumns([ // 批量添加数据列
                ['name', '名称'],
                ['title', '标题'],
                ['description', '描述'],
                ['developer', '开发者'],
                ['version', '版本'],
                ['create_time', '创建时间', 'datetime'],
                ['status', '状态'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons(['enable'=>['eve'=>'target'],'disable'=>['eve'=>'target']]) // 批量添加顶部按钮
            ->addRightButton('update',['title'=>'更新菜单','eve'=>'target'])//添加右部按钮
            ->extraRightButton(['status'=>0,'is_system'=>0],'disable',['eve'=>'target'])//添加额外禁用按钮
            ->extraRightButton(['status'=>1,'is_system'=>0],'enable',['eve'=>'target'])//添加额外启用按钮
            ->setRowList($data_list) // 设置表格数据
            ->fetch();//渲染模板
    }

    /**
     * 更新模块信息
     * @param int $id 模块id
     */
    public function update($id){
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
        if(false===$module->allowField(true)->validate(true)->isUpdate(true)->save($data)){
            $this->result([],0,$module->getError(),'json');
            $this->error($module->getError());
        }else{
            //清除菜单缓存
            cache(null,'admin_menu');
            //更新权限规则信息
            $res = model('AuthRule')->updateRule($config_info['admin_menu'],$config_info['info']['name']);
            if($res['status']){
                // 记录行为
                action_log('module_update', 'admin_module', $id, UID,$config_info['info']['title']);
                $this->success($res['msg'],'index');
            }else{
                $this->error($res['msg']);
            }
        }
    }
}