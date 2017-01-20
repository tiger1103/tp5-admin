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
            ->addRightButtons(['edit'=>['eve'=>'pop','pop-title'=>'编辑用户组'],'delete'=>['eve'=>'target']]) // 批量添加右侧按钮
            ->replaceRightButton(['id'=>config('SUPER_ADMIN_ID')],'<a title="超级管理员不可操作" icon="Hui-iconfont Hui-iconfont-suoding" class="btn btn-danger radius size-MINI" 
                url="javascript:void(0);" href="javascript:void(0);"><i class="Hui-iconfont Hui-iconfont-suoding"></i></a>')//替换右侧按钮
            ->setRowList($group_list) // 设置表格数据
            ->fetch();
    }

    /**
     * 添加用户组
     */
    public function add(){
        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if(isset($data['menus'])){
                $data['rules'] = implode(',',$data['menus']);
            }
            $group_model = model('Group');
            // 添加数据
            if (false===$role = $group_model->allowField(true)->isUpdate(false)->validate(true)->save($data)){
                return $this->result(null,0,$group_model->getError());
            }
            // 记录行为
            if(true!==$return = action_log('group_add', 'admin_auth_group', $group_model->id, UID,$data['title'])){
                return $this->result(null,0,$return);
            }
            return $this->result(null,1,'添加分组成功');
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

    /**
     * 修改用户组
     * @param $id
     */
    public function edit(){
        $id = input('id');
        //检查id参数是否合法
        $super_admin_id = config('SUPER_ADMIN_ID');
        array_unshift($super_admin_id,0);
        $id = intval($id);
        if(in_array($id,$super_admin_id)){
            if($this->request->isAjax()){
                return $this->result(null,0,'参数错误');
            }else{
                return $this->error('参数错误','add');
            }
        }

        // 保存数据
        if ($this->request->isPost()) {
            $data = $this->request->post();
            if(isset($data['menus'])){
                $data['rules'] = implode(',',$data['menus']);
            }
            $group_model = model('Group');
            $old_title = $group_model->where('id',$id)->value('title');
            // 修改数据
            if (false===$role = $group_model->allowField(true)->isUpdate(true)->validate(true)->save($data)){
                return $this->result(null,0,$group_model->getError());
            }
            // 记录行为
            if(true!==$return = action_log('group_edit', 'admin_auth_group', $id, UID,$old_title)){
                return $this->result(null,0,$return);
            }
            return $this->result(null,1,'修改分组成功');
        }

        //用户组
        $group_list = model('Group')->order('sort asc,id asc')->column('id,pid,title,status,sort');
        if(!isset($group_list[$id])){
            return $this->result(null,0,'参数错误,不存在的用户组信息');
        }
        $group = $group_list[$id];
        //过滤禁用组
        $group_list = array_filter($group_list,function($v){return $v['status']==1;});
        // 转换成树状列表
        $tree = new Tree();
        $group_list = $tree->toFormatTree($group_list);
        //获取菜单
        $menus = model('Module')->getAllMenu();
        //权限规则
        $rules = model('AuthRule')->column('id,name','name');
        //已经拥有的权限
        $own_rules_str = model('Group')->where('id',$id)->value('rules');
        $own_rules = array_flip(explode(',',$own_rules_str));
        $this->assign(
            [
                'menus' => $menus,
                'rules' => $rules,
                'group' => $group,
                'group_list' => $group_list,
                'own_rules' => $own_rules
            ]
        );
        return $this->fetch();
    }
}