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
        $auth_group_access = model('Admin')->authGroupAccess()->where(['uid'=>['in',$uid]])->column('uid,group_id','group_id');
        //将部门信息合并到管理员数据中
        foreach($admin_list as $k=>$v){
            $group =[];
            foreach($auth_group_access as $ak=>$av){
                if($v['id']==$av&&isset($group_list[$ak])){
                    $group[]=$group_list[$ak]['title'];
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

    public function add(){
        //获取用户组
        $group_list = model('Group')->groupList(['status'=>1]);

        // 设置Tab导航数据列表
        $config_group_list = config('CONFIG_GROUP_LIST');  // 获取配置分组
        $tab_list = [];

        // 使用Creater快速建立表单页面。
        return Instance::getInstance('form','AdminCreater')
        ->addFormItems([ // 批量添加表单项
            ['bmap','bm','地图标注','88bf9d5e3b73bf4fdb3a9524803a2dbc','请标注地图坐标。','','曲靖市麒麟区龙潭公园'],
            ['checkbox','city','所属城市','请选择城市',['gz' => '广州', 'sz' => '深圳', 'sh' => '上海'],['gz','sh'],['checkboxClass'=>'icheckbox_square-green']],
            ['ckeditor','ckcontent','相关内容','请填写相关内容','这个是默认值'],
            ['date','gdate','日期','请选日期','2016-12-20','YYYY-MM-DD'],
            ['daterange','sgdrang,egdtang','日期范围','请选择一个日期范围','2016-11-11,2016-12-12'],
            ['datetime','gdatetime','日期时间','请选日期时间','2016-12-20 12:12:12'],
            ['editormd','gmd','编辑内容','请填写内容','这个睡觉哦'],
            ['file','gfile','文件上传','请上传文件'],
            /*['text', 'username', '用户名', '必填，可由英文字母、数字组成'],
            ['text', 'nickname', '昵称', '可以是中文'],
            ['select', 'group', '用户组', '', $group_list],
            ['text', 'email', '邮箱', ''],
            ['password', 'password', '密码', '必填，6-20位'],
            ['text', 'mobile', '手机号'],
            ['image', 'avatar', '头像'],
            ['radio', 'status', '状态', '', ['禁用', '启用'], 1]*/
        ])
        ->fetch();
    }

}