<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2016/12/26
 * Time: 18:05
 */

namespace app\admin\controller;

class Admin extends Base
{
    public function index(){
        // 获取所有导航
        $module = model('Admin/Module');
        $menuList = $module->getAllMenu();
        $this->assign('_menu_list', $menuList);  // 后台主菜单
        return $this->fetch();
    }

    public function welcome(){
        return $this->fetch();
    }
}