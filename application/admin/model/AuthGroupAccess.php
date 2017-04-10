<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/23
 * Time: 9:42
 */

namespace app\admin\model;

/**
 * 管理员和用户组映射模型
 * @package app\admin\model
 */
class AuthGroupAccess extends Base
{
    /**
     * @var string 表名
     */
    protected $table='__ADMIN_AUTH_GROUP_ACCESS__';

    protected $validate = [
        'rule'=>[
            'uid'=>'require',
            'group_id' =>'require',
        ],
        'msg'=>[
            'uid'=>'管理员id不能为空',
            'group_id'=>'管理员组id不能为空',
        ]
    ];

    public function getUserGroupId($uid){
        return $this->where('uid',$uid)->column('group_id');
    }
}