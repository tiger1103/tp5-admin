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
        return $this->fetch();
    }

    public function welcome(){
        return $this->fetch();
    }
}