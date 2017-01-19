<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/18
 * Time: 11:38
 */

namespace app\admin\controller;


use app\common\creater\Instance;
use util\Tree;

class Group extends Base
{
    /**
     * 用户组管理
     */
    public function index(){
        $map = [];
        $group_list = model('Group')->where($map)->order('sort asc,id asc')->column('id,pid,title,status,sort,create_time,update_time');
        // 转换成树状列表
        $tree = new Tree();
        $group_list = $tree->toFormatTree($group_list);
        // 使用Creater快速建立列表页面。
        return Instance::getInstance('table','AdminCreater')
            ->setPageTitle('用户组管理') // 设置页面标题
            ->setBreadTree(['首页','系统权限','用户组管理'])//设置面包树
            ->addColumns([ // 批量添加数据列
                ['id', 'ID'],
                ['title_show', '组名','','','','text-l'],
                ['sort', '排序'],
                ['status', '状态', 'switch'],
                ['create_time', '创建日期', 'datetime', '', 'Y-m-d H:i:s'],
                ['update_time', '修改日期', 'datetime', '', 'Y-m-d H:i:s'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons(['add'=>['eve'=>'pop','pop-title'=>'添加用户组'],'enable'=>['eve'=>'target'],'disable'=>['eve'=>'target'],'delete'=>['eve'=>'target']]) // 批量添加顶部按钮
            ->addRightButtons(['edit'=>['eve'=>'pop'],'delete'=>['eve'=>'target']]) // 批量添加右侧按钮
            ->setRowList($group_list) // 设置表格数据
            ->fetch();
    }

    public function add(){
        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();
            $menus = $data['menus'];

            halt($menus);
            $group_model = model('Group');
            // 添加数据
            if (false===$role = $group_model->allowField(true)->isUpdate(false)->validate(true)->save($data)){
                halt($group_model->getError());
            }
            halt('未验证');
        }
        //获取菜单
        $menus = model('Module')->getAllMenu();
        //权限规则
        $rules = model('AuthRule')->column('id,name','name');
        //用户组
        $group_list = model('Group')->where('status',1)->order('sort asc,id asc')->column('id,pid,title,status,sort');
        // 转换成树状列表
        $tree = new Tree();
        $group_list = $tree->toFormatTree($group_list);

        $this->assign('menus',$menus);//菜单列表
        $this->assign('rules',$rules);
        $this->assign('group_list',$group_list);//用户组
        return $this->fetch();
    }
}