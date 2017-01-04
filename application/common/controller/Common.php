<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/3
 * Time: 10:07
 */

namespace app\common\controller;


use think\Controller;

class Common extends Controller
{
    /**
     * 模板显示 调用内置的模板引擎显示方法，
     * @access protected
     * @param string $templateFile 指定要调用的模板文件
     * 默认为空 由系统自动定位模板文件
     * @param string $charset 输出编码
     * @param string $contentType 输出类型
     * @param string $content 输出内容
     * @param string $prefix 模板缓存前缀
     * @return void
     */
    protected function display($template = '', $charset = '', $contentType = '', $content = '', $prefix = '') {
        if (!is_file($template)) {
            if ('' == $template) {
                // 如果模板文件名为空 按照默认规则定位
                $template = $this->request->controller() . DS . $this->request->action();
            } elseif (false === strpos($template, DS)) {
                $template = $this->request->controller() . DS . $template;
            }
        }
        // 获取所有模块配置的用户导航
        $mod_con['status'] = 1;
        $_user_nav_main = array();
        $_user_nav_list = model('admin/Module')->where($mod_con)->column('user_nav');
        foreach ($_user_nav_list as $key => $val) {
            if ($val) {
                $val = json_decode($val, true);
                if ($val['main']) {
                    $_user_nav_main = array_merge($_user_nav_main, $val['main']);
                }
            }
        }
        $this->assign('_admin_public_layout', config('appconfig.ADMIN_PUBLIC_LAYOUT')); // 页面公共继承模版
        if ($this->request->isAjax()) {
            $this->success('数据获取成功', '', array('data' => $this->view->get(), 'html' => $this->fetch($template)));
        } else {
            return $this->fetch($template);
        }
    }
}