<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2016/12/29
 * Time: 16:12
 */

namespace app\admin\controller;


class Role extends Base
{
    public function index(){
        return $this->fetch();
    }

    public function addRole(){
        return $this->fetch();
    }
}