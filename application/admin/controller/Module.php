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

    public function index(){
        $moduleId = $this->request->has('moduleId')?$this->request->get('moduleId'):1;
        $module = model('Module');
        $data_list = $module->getAll($moduleId);
        // 使用Builder快速建立列表页面。
        $builder = new \app\Common\Builder\ListBuilder();
        return $builder->setMetaTitle('模块列表')  // 设置页面标题
        ->addTopButton('resume')   // 添加启用按钮
        ->addTopButton('forbid')   // 添加禁用按钮
        ->setSearch('请输入ID/标题', url('index'))->addTableColumn('name', '名称')
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

}