<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/9
 * Time: 11:42
 */

namespace app\common\builder;


use app\common\controller\Common;
use think\Exception;

class InstanceBuilder extends Common
{
    /**
     * @var array 模板参数变量
     */
    protected $_vars = [];

    /**
     * 构建器初始化
     * @param string $type
     * @return mixed
     * @throws Exception
     */
    public static function getInstance($type=''){
        if ($type == '') {
            throw new Exception('未指定构建器名称');
        } else {
            $type = ucfirst(strtolower($type));
        }

        // 构造器类路径
        $class = '\\app\\common\\builder\\'. $type .'Builder';
        if (!class_exists($class)) {
            throw new Exception($type . '构建器不存在');
        }
        return new $class;
    }
    /**
     * 加载模板输出
     * @param string $template 模板文件名
     * @param array  $vars     模板输出变量
     * @param array  $replace  模板替换
     * @param array  $config   模板参数
     * @return mixed
     */
    public function fetch($template = '', $vars = [], $replace = [], $config = [])
    {
        $vars = array_merge($vars, $this->_vars);
        return parent::fetch($template, $vars, $replace, $config);
    }
}