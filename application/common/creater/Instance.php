<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/11
 * Time: 15:19
 */

namespace app\common\creater;


use app\common\controller\Common;

class Instance extends Common
{
    /**
     * @var array 模板参数变量
     */
    protected $_template_vars = [];

    /**
     * 构建器初始化
     * @param string $type
     * @return mixed
     * @throws Exception
     */
    public static function getInstance($dir='',$class='Creater'){
        if ($dir == '') {
            throw new Exception('未指定构建器目录');
        } else {
            $dir = strtolower($dir);
        }

        // 构造器类路径
        $class = '\\app\\common\\creater\\'. $dir .'\\'.$class;
        if (!class_exists($class)) {
            throw new Exception('构建器不存在');
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
        $vars = array_merge($this->_template_vars,$vars);
        return parent::fetch($template, $vars, $replace, $config);
    }

}