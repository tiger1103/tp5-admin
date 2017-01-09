<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/3
 * Time: 9:04
 */

namespace app\admin\controller;


use app\common\builder\InstanceBuilder;

class Config extends Base
{

    /*
     * 配置管理
     */
    public function index(){
        // 使用Builder快速建立列表页面。
        $builder = InstanceBuilder::getInstance('list');
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
            ->pluginView();
    }
    /**
     * 系统配置
     */
    public function configSet(){
        return $this->fetch();
    }
}