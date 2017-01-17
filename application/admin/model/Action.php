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

}