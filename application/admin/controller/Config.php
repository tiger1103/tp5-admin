<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/3
 * Time: 9:04
 */

namespace app\admin\controller;

use app\common\creater\Instance;
use think\Cache;

class Config extends Base
{

    /*
     * 配置管理
     */
    public function index($group = 1){
        // 设置Tab导航数据列表
        $config_group_list = config('CONFIG_GROUP_LIST');  // 获取配置分组
        $tab_list = [];
        foreach ($config_group_list as $key => $val) {
            $tab_list[$key]['title'] = $val;
            $tab_list[$key]['url']  = url('index', array('group' => $key));
        }
        $map = ['group'=>$group];
        $data_list = model('Config')->where($map)->order('id asc')->paginate();
        //创建数据表格
        return Instance::getInstance('table','AdminCreater')
            ->setPageTitle('配置管理') // 设置页面标题
            ->setTabNav($tab_list, $group) // 设置tab分页
            ->setBreadTree(['首页','系统配置','配置管理'])//设置面包树
            ->setSearch([
                'name'=>['title'=>'名称','type'=>'text','placeholder'=>'请输入名称'],
                'title'=>['title'=>'标题','type'=>'text','placeholder'=>'请输入标题']
            ])//设置搜索
            ->addColumns([ // 批量添加数据列
                ['name', '名称'],
                ['title', '标题'],
                ['type', '类型'],
                ['status', '状态', 'switch'],
                ['sort', '排序'],
                ['right_button', '操作', 'btn']
            ])
            ->addTopButton('add', ['url' => url('add', ['group' => $group])], true) // 添加单个顶部按钮
            ->addTopButtons(['enable'=>['eve'=>'target'],'disable'=>['eve'=>'target'],'delete'=>['eve'=>'target']]) // 批量添加顶部按钮
            ->addRightButton('edit', [], true)
            ->addRightButton('delete',['eve'=>'target']) // 批量添加右侧按钮
            ->setRowList($data_list) // 设置表格数据
            ->fetch(); // 渲染模板
    }
    /**
     * 系统配置
     */
    public function configSet(){
        return $this->fetch();
    }

}