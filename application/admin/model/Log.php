<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/16
 * Time: 10:55
 */

namespace app\admin\model;


class Log extends Base
{
    /**
     * @var string 表名
     */
    protected $table = '__ADMIN_LOG__';

    /**
     * 获取所有日志
     * @param array $map 条件
     * @param string $order 排序
     * @return mixed
     */
    public function getAll($map = [], $order = '')
    {
        $data_list = self::view('admin_log', true)
            ->view('admin_action', 'title,module', 'admin_action.id=admin_log.action_id', 'left')
            ->view('admin_admin', 'username', 'admin_admin.id=admin_log.user_id', 'left')
            ->view('admin_module', ['title' => 'module_title'], 'admin_module.name=admin_action.module')
            ->where($map)
            ->order($order)
            ->paginate();
        return $data_list;
    }
}