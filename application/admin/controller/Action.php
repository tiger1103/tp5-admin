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

    /**
     * 添加行为
     */
    public function add(){
        if($this->request->isPost()){
            $data = $this->request->post();
            $action_model = model('Action');
            // 添加数据
            if (false===$result = $action_model->allowField(true)->isUpdate(false)->validate(true)->save($data)){
                return $this->result(null,0,$action_model->getError());
            }
            return $this->result(null,1,'行为添加成功');
        }
        //获取所有模块
        $modules = \app\admin\model\Module::getModule();
        // 使用Creater快速建立表单页面。
        return Instance::getInstance('form','AdminCreater')
            ->setPageTitle('添加行为') // 设置页面标题
            ->setUrl(url('add'))
            ->token_open(true)
            ->addFormItems(
                [
                    ['select','module','所属模块','请选择所属模块',$modules],
                    ['text','name','行为标识','由英文字母和下划线组成'],
                    ['text', 'title', '行为名称', '请填写行为名称（可为中文）'],
                    ['textarea','remark','行为描述','请输入行为描述'],
                    ['textarea','rule','行为规则','不写则只记录日志'],
                    ['textarea','log','日志规则','记录日志备注时按此规则来生成，支持[变量|函数]。目前变量有：user,time,model,record,data,details'],
                    ['switch','status','是否启用','关闭后则该行为不可执行','1']
                ]
            )//批量添加表单项
            ->setFormValidate(
                ['module'=>'required','name'=>['required'=>true,'isRightfulString'=>true],'title'=>'required','remark'=>'required'],
                ['module'=>'请选择模块','name'=>['required'=>'行为标识不能为空','isRightfulString'=>'只能是英文字母或下划线组成'],
                    'title'=>'行为名称不能为空','remark'=>'行为描述不能为空'])//表单验证
            ->fetch();
    }

    /**
     * 修改行为
     */
    public function edit(){
        $id = input('id',0,'intval');
        $action_model = model('action');
        if($this->request->isPost()){
            $data = $this->request->post();
            if(!isset($data['status'])){
                $data['status'] = 0;
            }
            // 修改数据
            if (false===$result = $action_model->allowField(true)->isUpdate(true)->validate(true)->save($data)){
                return $this->result(null,0,$action_model->getError());
            }
            return $this->result(null,1,'行为修改成功');
        }
        $action = $action_model->where('id',$id)->find();
        if(!$action){
            return $this->error('参数错误');
        }
        //获取所有模块
        $modules = \app\admin\model\Module::getModule();
        // 使用Creater快速建立表单页面。
        return Instance::getInstance('form','AdminCreater')
            ->setPageTitle('添加行为') // 设置页面标题
            ->setUrl(url('edit'))
            ->token_open(true)
            ->addFormItems(
                [
                    ['hidden','id',$id],
                    ['select','module','所属模块','请选择所属模块',$modules,$action['module']],
                    ['text','name','行为标识','由英文字母和下划线组成',$action['name']],
                    ['text', 'title', '行为名称', '请填写行为名称（可为中文）',$action['title']],
                    ['textarea','remark','行为描述','请输入行为描述',$action['remark']],
                    ['textarea','rule','行为规则','不写则只记录日志',$action['rule']],
                    ['textarea','log','日志规则','记录日志备注时按此规则来生成，支持[变量|函数]。目前变量有：user,time,model,record,data,details',$action['log']],
                    ['switch','status','是否启用','关闭后则该行为不可执行','1',$action['status']]
                ]
            )//批量添加表单项
            ->setFormValidate(
                ['module'=>'required','name'=>['required'=>true,'isRightfulString'=>true],'title'=>'required','remark'=>'required'],
                ['module'=>'请选择模块','name'=>['required'=>'行为标识不能为空','isRightfulString'=>'只能是英文字母或下划线组成'],
                    'title'=>'行为名称不能为空','remark'=>'行为描述不能为空'])//表单验证
            ->fetch();
    }

    /**
     * 设置行为状态
     */
    public function setStatus(){
        $ids = input('ids');
        $action = input('action');
        if($ids==''||$action==''){
            return $this->error('参数错误');
        }
        $id = explode(',',$ids);
        $action_model = model('Action');
        if($action_model->where(['id'=>['in',$id]])->setField('status',$action=='enable'?1:0)!==false){
            return $this->success('状态设置成功','index');
        }
        return $this->error('状态设置失败');
    }

    /**
     * 删除行为
     */
    public function delete(){
        $ids = input('ids');
        if($ids==''){
            return $this->error('参数错误');
        }
        $id = explode(',',$ids);
        $action_model = model('Action');
        if($action_model->where(['id'=>['in',$id]])->delete()!==false){
            return $this->success('删除成功','index');
        }
        return $this->error('删除失败');
    }
}