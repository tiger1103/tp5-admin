<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/16
 * Time: 10:52
 */

namespace app\admin\controller;
use app\common\creater\Instance;

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
        $order = 'id desc';
        // 数据列表
        $data_list = model('Log')->getAll($map, $order);
        // 分页数据
        $page = $data_list->render();
        // 使用Creater快速建立列表页面。
        return Instance::getInstance('table','AdminCreater')
            ->setPageTitle('系统日志') // 设置页面标题
            ->setBreadTree(['首页','系统管理','日志管理'])//设置面包树
            ->addTopButton('delete',['eve'=>'target'])//顶部按钮
            ->addColumns([ // 批量添加数据列
                ['id', '编号'],
                ['title', '行为名称'],
                ['username', '执行者'],
                ['action_ip', '执行IP', 'callback', 'long2ip'],
                ['module_title', '所属模块'],
                ['create_time', '执行时间'],
                ['right_button', '操作', 'btn']
            ])
            ->addRightButton('custom', ['icon' => 'Hui-iconfont Hui-iconfont-yanjing',
                'title' => '详情','class'=>'btn btn-success radius size-MINI','eve'=>'pop',
                'url' => url('details', ['id' => '__id__']),'pop-full'=>true])//查看详情
            ->addRightButton('delete',['eve'=>'target'])//删除
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染模板
    }

    /**
     * 系统日志详情
     */
    public function details(){
        $id = input('id',0,'intval');
        $log = model('Log')->getOne($id);
        if(!$log){
            return $this->error('日志信息不存在');
        }
        // 使用Creater快速建立列表页面。
        return Instance::getInstance('form','AdminCreater')
            ->setPageTitle('系统日志详情') // 设置页面标题
            ->addFormItems([ // 批量添加表单项
                ['hidden', 'id'],
                ['static', 'title', '行为名称'],
                ['static', 'username', '执行者'],
                ['static', 'record_id', '目标ID'],
                ['static', 'action_ip', '执行IP'],
                ['static', 'module_title', '所属模块'],
                ['textarea', 'remark', '备注'],
            ])
            ->hideBtn('submit')
            ->setFormData($log) // 设置表单数据
            ->fetch();
    }

    /**
     * 删除系统日志
     */
    public function delete(){
        $ids = input('ids');
        if($ids==''){
            return $this->error('参数错误');
        }
        $id = explode(',',$ids);
        $log_model = model('Log');
        if($log_model->where(['id'=>['in',$id]])->delete()!==false){
            return $this->success('删除成功','index');
        }
        return $this->error('删除失败');
    }
}