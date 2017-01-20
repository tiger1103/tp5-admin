<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/18
 * Time: 11:57
 */

namespace app\admin\model;


class Group extends Base
{
    /**
     * @var string 表名
     */
    protected $table = '__ADMIN_AUTH_GROUP__';
    protected $autoWriteTimestamp = true;
    protected $auto = ['status'];

    /**
     * 排序修改器
     * @param $value
     * @return int
     */
    protected function setSortAttr($value){
        return intval($value);
    }

    /**
     * 状态修改器
     * @param $value
     * @return int
     */
    protected function setStatusAttr($value){
        if(!empty($value)){
            return 1;
        }
        return 0;
    }


}