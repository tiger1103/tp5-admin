<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/22
 * Time: 17:56
 */

namespace app\admin\controller;


use app\common\creater\Instance;
use util\ArrayTools;

class Manager extends Base
{
    /**
     * 管理员列表
     * @return mixed
     */
    public function index(){
        $map = [];
        $order = 'id asc';
        //管理员列表数据
        $admin_list = model('Admin')->getAll($map,$order,'id,username,nickname,status,phone,create_time');
        //部门数据
        $group_list = model('Group')->order('sort asc,id asc')->column('id,pid,title,sort');
        //管理员所在部门
        $uid = ArrayTools::manyToOne($admin_list,'id','id');
        $auth_group_access = model('Admin')->authGroup()->where(['uid'=>['in',$uid]])->select();
        //将部门信息合并到管理员数据中
        foreach($admin_list as $k=>$v){
            $group =[];
            foreach($auth_group_access as $ak=>$av){
                if($v['id']==$av['uid']&&isset($group_list[$av['group_id']])){
                    $group[]=$group_list[$av['group_id']]['title'];
                }
            }
            $v['group'] = implode('、',$group);
        }
        // 使用Creater快速建立列表页面。
        return Instance::getInstance('table','AdminCreater')
            ->setPageTitle('管理员管理') // 设置页面标题
            ->setBreadTree(['首页','系统权限','管理员管理'])//设置面包树
            ->addColumns([ // 批量添加数据列
                ['id', 'ID'],
                ['username', '用户名'],
                ['nickname', '姓名'],
                ['group','所属部门'],
                ['phone','手机号码'],
                ['create_time', '创建日期'],
                ['status', '状态', 'switch'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButtons(['add'=>['eve'=>'pop','pop-title'=>'添加管理员'],'enable'=>['eve'=>'target'],'disable'=>['eve'=>'target'],'delete'=>['eve'=>'target']]) // 批量添加顶部按钮
            ->addRightButtons(['edit'=>['eve'=>'pop','pop-title'=>'编辑管理员'],'delete'=>['eve'=>'target']]) // 批量添加右侧按钮
            ->replaceRightButton(['id'=>config('SUPER_ADMIN_ID')],'<a title="超级管理员不可操作" icon="Hui-iconfont Hui-iconfont-suoding" class="btn btn-danger radius size-MINI" 
                url="javascript:void(0);" href="javascript:void(0);"><i class="Hui-iconfont Hui-iconfont-suoding"></i></a>')//替换右侧按钮
            ->setRowList($admin_list) // 设置表格数据
            ->fetch();
    }

    /**
     * 添加管理员
     */
    public function add(){
        if($this->request->isPost()){
            $admin_modle = model('Admin');
            $data = $this->request->post();
            if($data['password']!=''){
                $data['salt'] = mt_rand(100000,999999);//密码加密盐
                $data['password'] = encypt_password($data['password'],$data['salt']);//生成密码
            }
            // 添加数据
            if (false===$result = $admin_modle->allowField(true)->isUpdate(false)->validate(true)->save($data)){
                return $this->result($admin_modle->getError(),0);
            }
            $uid = $admin_modle->id;
            $group_access_data = [];//用户及用户组关联数据
            foreach($data['group'] as $k=>$v){
                $group_access_data[$k]['uid'] = $uid;
                $group_access_data[$k]['group_id'] = $v;
            }
            //添加管理员及管理员组的关联数据
            $admin_modle->authGroup()->saveAll($group_access_data);
            // 记录行为日志
            if(true!==$return = action_log('admin_add', 'admin_admin', $uid, UID,$data['username'])){
                return $this->result(null,0,$return);
            }
            return $this->result('管理员添加成功',1);
        }
        //获取用户组
        $group_list = model('Group')->groupList(['status'=>1]);
        $group_list = ArrayTools::manyToOne($group_list,'id','title_show');
        // 使用Creater快速建立表单页面。
        return Instance::getInstance('form','AdminCreater')
        ->setPageTitle('添加管理员') // 设置页面标题
        ->setUrl(url('add'))
        ->token_open(true)
        ->addFormItems(
            [
                ['text','username','用户名','请填写用户名','',['<i class="Hui-iconfont Hui-iconfont-user"></i>']],
                ['text','nickname','姓名/昵称','请填写用姓名/昵称','',['<i class="Hui-iconfont Hui-iconfont-root"></i>']],
                ['select', 'group', '用户组', '请选择用户组（可多选）', $group_list,'','multiple'],
                ['password','password','密码','请输入密码',''],
				['switch','status','状态','管理员状态，关闭后无法登陆系统','1'],
                ['text','phone','手机号码','请填写手机号码','',['<i class="Hui-iconfont Hui-iconfont-phone"></i>']],
            ]
        )//批量添加表单项
        ->setFormValidate(
            ['username'=>'required','nickname'=>'required','group[]'=>'required','password'=>'required',
                'phone'=>['required'=>true,'isMobile'=>true]],
            ['username'=>'用户名不能为空','nickname'=>'昵称不能为空','group[]'=>'请选择用户组',
            'password'=>'密码不能为空','phone'=>['required'=>'手机号码不能为空','isMobile'=>'手机号格式不正确']])//表单验证
        ->fetch();
    }

    public function edit(){
        $id = input('id',0,'intval');
        $admin_modle = model('Admin');
        if($this->request->isPost()){
            $data = $this->request->post();
            if($data['password']!=''){
                $data['salt'] = mt_rand(100000,999999);//密码加密盐
                $data['password'] = encypt_password($data['password'],$data['salt']);//生成密码
            }else{
                //未填写密码则不修改密码
                unset($data['password']);
            }
            //用户状态
            if(!isset($data['status'])){
                $data['status'] = 'off';
            }
            // 修改用户数据
            if (false===$result = $admin_modle->allowField(true)->isUpdate(true)->validate('Admin.edit')->save($data,['id'=>$id])){
                return $this->result($admin_modle->getError(),0);
            }
            $group_access_data = [];//用户及用户组关联数据
            foreach($data['group'] as $k=>$v){
                $group_access_data[$k]['uid'] = $id;
                $group_access_data[$k]['group_id'] = $v;
            }
            //删除管理员与管理员组关联数据
            $admin_modle->authGroup()->where(['uid'=>$id])->delete();
            //添加管理员与管理员组的关联数据
            $admin_modle->authGroup()->saveAll($group_access_data);
            // 记录行为日志
            if(true!==$return = action_log('admin_edit', 'admin_admin', $id, UID,$data['username'])){
                return $this->result(null,0,$return);
            }
            return $this->result('管理员修改成功',1);
        }
        //获取用户信息
        $info = $admin_modle->find($id);
        if(!$info){
            return $this->error('用户信息不存在。');
        }
        //获取用户所属用户组信息
        $belong_group = $admin_modle->find(['uid'=>$id])->authGroupAccess;
        //获取所属用户组id
        $belong_group_list = ArrayTools::manyToOne($belong_group,'id','id');
        //获取用户组数据
        $group_list = model('Group')->groupList(['status'=>1]);
        $group_list = ArrayTools::manyToOne($group_list,'id','title_show');
        // 使用Creater快速建立表单页面。
        return Instance::getInstance('form','AdminCreater')
            ->setPageTitle('添加管理员') // 设置页面标题
            ->setUrl(url('edit'))
            ->token_open(true)
            ->addFormItems(
                [
                    ['hidden','id',$id],
                    ['text','username','用户名','请填写用户名',$info['username'],['<i class="Hui-iconfont Hui-iconfont-user"></i>']],
                    ['text','nickname','姓名/昵称','请填写用姓名/昵称',$info['nickname'],['<i class="Hui-iconfont Hui-iconfont-root"></i>']],
                    ['select', 'group', '用户组', '请选择用户组（可多选）', $group_list,$belong_group_list,'multiple'],
                    ['password','password','密码','请输入密码',''],
                    ['switch','status','状态','管理员状态，关闭后无法登陆系统',$info['status'],$info['status']],
                    ['text','phone','手机号码','请填写手机号码',$info['phone'],['<i class="Hui-iconfont Hui-iconfont-phone"></i>']],
                ]
            )//批量添加表单项
            ->setFormValidate(
                ['username'=>'required','nickname'=>'required','group[]'=>'required',
                    'phone'=>['required'=>true,'isMobile'=>true]],
                ['username'=>'用户名不能为空','nickname'=>'昵称不能为空','group[]'=>'请选择用户组',
                    'phone'=>['required'=>'手机号码不能为空','isMobile'=>'手机号格式不正确']])//表单验证
            ->fetch();
    }


}