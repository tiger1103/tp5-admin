<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/2/13
 * Time: 9:34
 */

namespace app\admin\controller;


use app\common\controller\Common;
use think\Db;

class Ajax extends Common
{
    /**
     * 获取联动数据
     * @param string $table 表名
     * @param int $pid 父级ID
     * @param string $key 下拉选项的值
     * @param string $option 下拉选项的名称
     * @param string $pidkey 父级id字段名
     * @return \think\response\Json
     */
    public function getLevelData($table = '', $pid = 0, $key = 'id', $option = 'name', $pidkey = 'pid')
    {
        if ($table == '') {
            return json(['code' => 0, 'msg' => '缺少表名']);
        }

        $data_list = Db::name($table)->where($pidkey, $pid)->column($option, $key);

        if ($data_list === false) {
            return json(['code' => 0, 'msg' => '查询失败']);
        }

        if ($data_list) {
            $result = [
                'code' => 1,
                'msg'  => '请求成功',
                'list' => format_linkage($data_list)
            ];
            return json($result);
        } else {
            return json(['code' => 0, 'msg' => '查询不到数据']);
        }
    }
}