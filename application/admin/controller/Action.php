<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/18
 * Time: 10:08
 */

namespace app\admin\controller;


use app\admin\model\Module;
use app\common\creater\Instance;

class Action extends Base
{
    /**
     * 行为管理
     */
    public function index(){
        $map = [];
        $order = 'id desc';
        // 数据列表
        $data_list = \app\admin\model\Action::where($map)->order($order)->paginate();
        //模块
        $module_list = Module::getModule();
        // 使用Creater快速建立列表页面。
        return Instance::getInstance('table','AdminCreater')
            ->setPageTitle('行为管理') // 设置页面标题
            ->setBreadTree(['首页','系统管理','行为管理'])//设置面包树
            ->addColumns([ // 批量添加数据列
                ['id', 'ID'],
                ['name', '标识'],
                ['title', '名称'],
                ['remark', '描述'],
                ['module', '所属模块', 'callback', function($module, $module_list){
                    return isset($module_list[$module]) ? $module_list[$module] : '未知';
                }, $module_list],
                ['status', '状态', 'switch'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons(['add'=>['eve'=>'pop'],'enable'=>['eve'=>'target'],'disable'=>['eve'=>'target'],'delete'=>['eve'=>'target']]) // 批量添加顶部按钮
            ->addRightButtons(['edit'=>['eve'=>'pop'],'delete'=>['eve'=>'target']]) // 批量添加右侧按钮
            ->setRowList($data_list) // 设置表格数据
            ->fetch();
    }
}