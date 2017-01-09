<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/9
 * Time: 16:17
 */

namespace app\admin\model;


class Config extends Base
{
    /**
     * @var string 模型名称
     */
    protected $name = 'admin_config';
    /**
     * 获取配置列表与ThinkPHP配置合并
     * @return array 配置数组
     */
    public function getConfig($status = 1) {
        $list = $this->where('status',$status)->field('name,value,type')->column(true);
        foreach ($list as $key => $val) {
            switch ($val['type']) {
                case 'array':
                    $config[$val['name']] = parse_attr($val['value']);
                    break;
                case 'checkbox':
                    $config[$val['name']] = explode(',', $val['value']);
                    break;
                default:
                    $config[$val['name']] = $val['value'];
                    break;
            }
        }
        return $config;
    }
}