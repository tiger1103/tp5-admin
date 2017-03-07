<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/17
 * Time: 16:06
 */

namespace app\admin\model;


class Action extends Base
{
    /**
     * @var string 表名
     */
    protected $table = '__ADMIN_ACTION__';

    /**
     * @var bool 自动写入时间戳
     */
    protected $autoWriteTimestamp = true;

    /**
     * 状态属性修改器
     * @param $value
     * @return int
     */
    protected function setStatusAttr($value){
        if(is_string($value)){
            if($value=='on')
                return 1;
            else if($value=='off')
                return 0;
        }
        return $value;
    }


}