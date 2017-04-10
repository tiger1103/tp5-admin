<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2016/12/27
 * Time: 9:21
 */

namespace app\admin\controller;


use app\common\controller\Common;



class Base extends Common
{

    public function _initialize(){
        parent::_initialize();
        // 后台公共模板
        $this->assign('_admin_base_layout', config('appConfig.ADMIN_BASE_LAYOUT'));
        //判断登录
        defined('UID') or define('UID',$this->checkLogin());
        //判断权限
        $authRule = model('AuthRule','logic');
        $authRule->getUrl();
        if(!$authRule->checkAuth()) $this->error('没有操作权限',url('admin/Admin/welcome'));
    }

    /**
     * 检查登录
     */
    private function checkLogin(){
        //判断是否登录
        $aid = isLogin();
        //检查登录
        if($aid<1){
            //跳转到登录页面
            $this->redirect('index/index');
            return;
        }
        return $aid;
    }


}