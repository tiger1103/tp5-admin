<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/16
 * Time: 10:52
 */

namespace app\admin\controller;

/**
 * 系统操作日志管理
 * @package app\admin\controller
 */
class Log extends Base
{
    /**
     * 日志列表
     * @return mixed
     */
    public function index()
    {
        $map = [];
        $order = 'order by id desc';
        // 数据列表
        $data_list = LogModel::getAll($map, $order);
        // 分页数据
        $page = $data_list->render();

        // 使用ZBuilder快速创建数据表格
        return ZBuilder::make('table')
            ->setPageTitle('系统日志') // 设置页面标题
            ->setSearch(['admin_action.title' => '行为名称', 'admin_user.username' => '执行者', 'admin_module.title' => '所属模块']) // 设置搜索框
            ->hideCheckbox()
            ->addColumns([ // 批量添加数据列
                ['id', '编号'],
                ['title', '行为名称'],
                ['username', '执行者'],
                ['action_ip', '执行IP', 'callback', 'long2ip'],
                ['module_title', '所属模块'],
                ['create_time', '执行时间', 'datetime', '', 'Y-m-d H:i:s'],
                ['right_button', '操作', 'btn']
            ])
            ->addOrder(['title' => 'admin_action', 'username' => 'admin_user', 'module_title' => 'admin_module.title'])
            ->addFilter(['admin_action.title', 'admin_user.username', 'module_title' => 'admin_module.title'])
            ->addRightButton('edit', ['icon' => 'fa fa-eye', 'title' => '详情', 'href' => url('details', ['id' => '__id__'])])
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染模板
    }
}