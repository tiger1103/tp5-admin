<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/3/1
 * Time: 9:41
 */

namespace app\admin\model;
use util\Tree;
/**
 * 此类用于决解tp5多对多关联模型表名属性:__表面__不解析的bug 从Group抽取为基类
 * Class AdminAuthGroup
 * @package app\admin\model
 */
class AdminAuthGroup extends Base
{
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

    /**
     * 获取用户组排序后的数据
     * @param array $map
     * @return array|mixed
     */
    public function groupList($map=[]){
        $group_list = cache('group_list');
        if(!$group_list||config('APP_DEBUG')===true){
            //用户组
            $group_list = model('Group')->where($map)->order('sort asc,id asc')->column('id,pid,title,status,sort,create_time,update_time');
            // 转换成树状列表
            $tree = new Tree();
            $group_list = $tree->toFormatTree($group_list);
            cache('group_list',$group_list,null,get_cache_tag('admin_group'));
        }
        return $group_list;
    }
}