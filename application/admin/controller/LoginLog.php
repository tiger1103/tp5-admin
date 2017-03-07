<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/3/7
 * Time: 16:22
 */

namespace app\admin\controller;


use app\common\creater\Instance;
use think\Db;

class LoginLog extends Base
{
    /**
     * 登录日志列表
     * @return mixed
     */
    public function index(){
        $map = [];
        $order = 'id desc';
        // 数据列表
        $data_list = Db::view('admin_adminloginlog',true)
            ->view('admin_admin','nickname','admin_admin.username=admin_adminloginlog.username','LEFT')
            ->where($map)->order($order)->paginate();
        // 分页数据
        $page = $data_list->render();
        // 使用Creater快速建立列表页面。
        return Instance::getInstance('table','AdminCreater')
            ->setPageTitle('登录日志') // 设置页面标题
            ->setBreadTree(['首页','系统管理','登录日志'])//设置面包树
            ->addTopButton('delete',['eve'=>'target'])//顶部按钮
            ->addColumns([ // 批量添加数据列
                ['id', '编号'],
                ['username', '用户名'],
                ['nickname', '真实姓名'],
                ['loginip', '登录ip'],
                ['logintime', '登录日期','datetime'],
                ['status', '登录状态','status','',['登录失败','登录成功','label-danger','label-primary']],
                ['mess','登录信息'],
                ['right_button','操作','btn']
            ])
            ->addRightButton('delete',['eve'=>'target'])//删除
            ->setRowList($data_list) // 设置表格数据
            ->setPages($page) // 设置分页数据
            ->fetch(); // 渲染模板
    }

    /**
     * 删除登录日志
     */
    public function delete(){
        $ids = input('ids');
        if($ids==''){
            return $this->error('参数错误');
        }
        $id = explode(',',$ids);
        $list = Db::name('admin_adminloginlog')->where(['id'=>['in',$id]])->select();
        $details = '';
        foreach($list as $k=>$v){
            $details .= '[用户名：'.$v['username'].'登录日期：'.date('Y-m-d H:i',$v['logintime']).
                '登录ip：'.$v['loginip'].'登录状态：'.$v['mess'].']；'."\n";
        }
        // 记录行为日志
        if(true!==$return = action_log('loginlog_delete', 'admin_adminloginlog', 0, UID,$details)){
            return $this->error($return);
        }
        if(Db::name('admin_adminloginlog')->delete($id)!==false){
            return $this->success('删除成功','index');
        }
        return $this->error('删除失败');
    }
}