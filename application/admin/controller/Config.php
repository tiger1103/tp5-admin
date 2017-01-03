<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/3
 * Time: 9:04
 */

namespace app\admin\controller;


class Config extends Base
{

    /**
     * 系统配置
     */
    public function configSet(){
        return $this->fetch();
    }
}