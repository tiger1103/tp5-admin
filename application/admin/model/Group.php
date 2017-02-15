<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/18
 * Time: 11:57
 */

namespace app\admin\model;


use util\Tree;

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
            cache('group_list',$group_list,null,get_cache_tag('auth_group'));
        }
        return $group_list;
    }


}