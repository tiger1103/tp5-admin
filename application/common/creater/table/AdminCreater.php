<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/11
 * Time: 15:37
 */

namespace app\common\creater\table;


use app\common\creater\Instance;

/**
 * Class AdminCreater 表格构建器
 * @package app\common\creater\table
 */
class AdminCreater extends Instance
{
    /**
     * @var string 当前模型名称
     */
    private $_module = '';

    /**
     * @var string 当前控制器名称
     */
    private $_controller = '';

    /**
     * @var string 当前操作名称
     */
    private $_action = '';

    /**
     * @var string 数据表名
     */
    private $_table_name = '';

    /**
     * @var array 要替换的右侧按钮内容
     */
    private $_replace_right_buttons = [];

    /**
     * @var array 额外的右键菜单
     */
    private $_extra_right_buttons = [];
    /**
     * @var string 插件名称
     */
    private $_plugin_name = '';

    /**
     * @var string 模板路径
     */
    private $_template = '';

    /**
     * @var bool 是否有分页数据
     */
    private $_has_pages = true;

    /**
     * @var array 模板变量
     */
    private $_vars = [
        'page_title'         => '',       // 页面标题
        'bread_tree'        =>[],       //顶部面包树
        'tab_nav'            => [],       // 页面Tab导航
        'hide_checkbox'      => false,    // 是否隐藏第一列多选
        'extra_html'         => '',       // 额外HTML代码
        'extra_js'           => '',       // 额外JS代码
        'extra_css'          => '',       // 额外CSS代码
        'top_buttons'        => [],       // 顶部栏按钮
        'right_buttons'      => [],       // 表格右侧按钮
        'search'             => [],       // 搜索参数
        'search_info'       =>[],       //搜索框信息
        'columns'            => [],       // 表格列集合
        'pages'              => '',       // 分页数据
        'row_list'           => [],       // 表格数据列表
        '_page_info'         => '',       // 分页信息
        'primary_key'        => 'id',     // 表格主键名称
        '_table'             => '',       // 表名
        'js_list'            => [],       // js文件名
        'css_list'           => [],       // css文件名
    ];

    /**
     * 初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->_module     = $this->request->module();
        $this->_controller = $this->request->controller();
        $this->_action     = $this->request->action();
        $this->_table_name = strtolower($this->_module.'_'.$this->_controller);
        $this->_template   = APP_PATH. 'common/creater/table/layout/admin.html';
    }

    /**
     * 设置页面标题
     * @param string $page_title 页面标题
     * @return $this
     */
    public function setPageTitle($page_title = '')
    {
        $this->_vars['page_title'] = $page_title;
        return $this;
    }

    /**
     * 设置面包树
     * @param array $data 面包树数据
     * @return $this
     */
    public function setBreadTree($data=[]){
        $this->_vars['bread_tree'] = $data;
        return $this;
    }

    /**
     * 隐藏第一列多选框
     * @return $this
     */
    public function hideCheckbox()
    {
        $this->_vars['hide_checkbox'] = true;
        return $this;
    }

    /**
     * 设置Tab按钮列表
     * @param array $tab_list Tab列表  ['title' => '标题', 'href' => 'http://www.qjit.cn']
     * @param string $curr_tab 当前tab
     * @return $this
     */
    public function setTabNav($tab_list = [], $curr_tab = '')
    {
        if (!empty($tab_list)) {
            $this->_vars['tab_nav'] = [
                'tab_list' => $tab_list,
                'curr_tab' => $curr_tab,
            ];
        }
        return $this;
    }

    /**
     * 设置搜索参数
     * @param array $fields 参与搜索的字段
     * @param string $url 提交地址
     * @return $this
     */
    public function setSearch($fields = [],$url = '')
    {
        if (!empty($fields)) {
            $this->_vars['search'] = [
                'fields'      => $fields,
                'url'         => $url == '' ? $this->request->url() : $url
            ];
        }
        return $this;
    }

    /**
     * 添加一列
     * @param string $name 字段名称
     * @param string $title 列标题
     * @param string $type 单元格类型
     * @param string $default 默认值
     * @param string $param 额外参数
     * @param string $class css类名
     * @return $this
     */
    public function addColumn($name = '', $title = '', $type = '', $default = '', $param = '', $class = '')
    {
        $column = [
            'name'    => $name,
            'title'   => $title,
            'type'    => $type,
            'default' => $default,
            'param'   => $param,
            'class'   => $class
        ];
        $this->_vars['columns'][] = $column;
        return $this;
    }

    /**
     * 一次性添加多列
     * @param array $columns 数据列
     * @return $this
     */
    public function addColumns($columns = [])
    {
        if (!empty($columns)) {
            foreach ($columns as $column) {
                call_user_func_array([$this, 'addColumn'], $column);
            }
        }
        return $this;
    }

    /**
     * 设置表格数据列表
     * @param array $row_list 表格数据
     * @return $this
     */
    public function setRowList($row_list = [])
    {
        if (is_array($row_list) && !empty($row_list)) {
            $this->_vars['row_list'] = $row_list;
        } elseif (is_object($row_list) && !$row_list->isEmpty()) {
            $this->_vars['row_list']   = is_object(current($row_list->getIterator())) ? $row_list : $row_list->all();
            $this->_vars['_page_info'] = $row_list;
            // 设置分页
            $this->setPages($row_list->render());
        }
        return $this;
    }

    /**
     * 设置表格主键
     * @param string $key 主键名称
     * @return $this
     */
    public function setPrimaryKey($key = '')
    {
        $this->_vars['primary_key'] = $key;
        return $this;
    }

    /**
     * 设置分页
     * @param string $pages 分页数据
     * @return $this
     */
    public function setPages($pages = '')
    {
        $this->_vars['pages'] = $pages;
        return $this;
    }

    /**
     * 设置为无分页
     * @return $this
     */
    public function noPages()
    {
        $this->_has_pages = false;
        return $this;
    }

    /**
     * 设置额外代码
     * @param string $extra_html 额外代码
     * @author 蔡伟明 <314013107@qq.com>
     * @return $this
     */
    public function setExtraHtml($extra_html = '')
    {
        $this->_vars['extra_html'] = $extra_html;
        return $this;
    }

    /**
     * 设置额外JS代码
     * @param string $extra_js 额外JS代码
     * @author 蔡伟明 <314013107@qq.com>
     * @return $this
     */
    public function setExtraJs($extra_js = '')
    {
        $this->_vars['extra_js'] = $extra_js;
        return $this;
    }

    /**
     * 设置额外CSS代码
     * @param string $extra_css 额外CSS代码
     * @return $this
     */
    public function setExtraCss($extra_css = '')
    {
        $this->_vars['extra_css'] = $extra_css;
        return $this;
    }

    /**
     * 设置页面模版
     * @param string $template 模版
     * @return $this
     */
    public function setTemplate($template = '')
    {
        $this->_template = $template;
        return $this;
    }

    /**
     * 添加一个顶部按钮
     * @param string $type 按钮类型：add/enable/disable/back/delete/custom
     * @param array $attribute 按钮属性
     * @param bool $pop 是否使用弹出框形式
     * @return $this
     */
    public function addTopButton($type = '', $attribute = [], $pop = false)
    {
        // 按钮属性
        $btn_attribute = [];
        // 表单名，用于替换
        $table = isset($attribute['table']) ? $attribute['table'] : '__table__';

        // 这个专门为插件准备的属性，是插件名称
        $plugin_name = isset($attribute['plugin_name']) ? $attribute['plugin_name'] : $this->_plugin_name;

        switch ($type) {
            // 新增按钮
            case 'add':
                // 默认属性
                $btn_attribute = [
                    'title' => '新增',
                    'icon'  => 'Hui-iconfont Hui-iconfont-add',
                    'class' => 'btn btn-primary radius',
                    'url'  => url(
                        $this->_module.'/'.$this->_controller.'/add',
                        ['plugin_name' => $plugin_name]
                    ),
                ];
                break;

            // 启用按钮
            case 'enable':
                // 默认属性
                $btn_attribute = [
                    'title'       => '启用',
                    'icon'        => 'Hui-iconfont Hui-iconfont-gouxuan2',
                    'class'       => 'btn btn-success radius',
                    'target-form' => 'ids',
                    'url'        => url(
                        $this->_module.'/'.$this->_controller.'/setStatus',
                        ['action'=>'enable','table' => $table]
                    ),
                ];
                break;

            // 禁用按钮
            case 'disable':
                // 默认属性
                $btn_attribute = [
                    'title'       => '禁用',
                    'icon'        => 'Hui-iconfont Hui-iconfont-shenhe-tingyong',
                    'class'       => 'btn btn-warning radius',
                    'target-form' => 'ids',
                    'url'        => url(
                        $this->_module.'/'.$this->_controller.'/setStatus',
                        ['action'=>'disable','table' => $table]
                    ),
                ];
                break;

            // 返回按钮
            case 'back':
                // 默认属性
                $btn_attribute = [
                    'title' => '返回',
                    'icon'  => 'Hui-iconfont  Hui-iconfont-chexiao',
                    'class' => 'btn btn-default radius',
                    'url'  => 'javascript:history.back(-1);'
                ];
                break;

            // 删除按钮(不可恢复)
            case 'delete':
                // 默认属性
                $btn_attribute = [
                    'title'       => '删除',
                    'icon'        => 'Hui-iconfont Hui-iconfont-del3',
                    'class'       => 'btn btn-danger radius',
                    'target-form' => 'ids',
                    'target-action'=>'delete',
                    'url'        => url(
                        $this->_module.'/'.$this->_controller.'/delete',
                        ['table' => $table]
                    ),
                ];
                break;

            // 自定义按钮
            case 'custom':
                // 默认属性
                $btn_attribute = [
                    'title'       => '定义按钮',
                    'class'       => 'btn btn-default radius',
                    'target-form' => 'ids',
                    'url'        => 'javascript:void(0);'
                ];
                break;
        }

        // 合并自定义属性
        if ($attribute && is_array($attribute)) {
            $btn_attribute = array_merge($btn_attribute, $attribute);
        }

        // 是否为弹出框方式
        if ($pop) {
            $btn_attribute['eve'] = 'pop';
        }
        $this->_vars['top_buttons'][] = $btn_attribute;
        return $this;
    }


    /**
     * 一次性添加多个顶部按钮
     * @param array|string $buttons 按钮类型
     * 例如：
     * $builder->addTopButtons('add');
     * $builder->addTopButtons('add,delete');
     * $builder->addTopButtons(['add', 'delete']);
     * $builder->addTopButtons(['add' => ['table' => '__USER__'], 'delete']);
     *
     * @return $this
     */
    public function addTopButtons($buttons = [])
    {
        if ($buttons) {
            $buttons = is_array($buttons) ? $buttons : explode(',', $buttons);
            foreach ($buttons as $key => $value) {
                if (is_numeric($key)) {
                    $this->addTopButton($value);
                } else {
                    $this->addTopButton($key, $value);
                }
            }
        }
        return $this;
    }

    /**
     * 添加一个右侧按钮
     * @param string $type 按钮类型：edit/enable/disable/delete/custom
     * @param array $attribute 按钮属性
     * @param bool $pop 是否使用弹出框形式
     * @return $this
     */
    public function addRightButton($type = '', $attribute = [], $pop = false)
    {
        // 按钮属性
        $btn_attribute = [];

        // 表单名，用于替换
        $table = isset($attribute['table']) ? $attribute['table'] : '__table__';

        // 这个专门为插件准备的属性，是插件名称
        $plugin_name = isset($attribute['plugin_name']) ? $attribute['plugin_name'] : $this->_plugin_name;

        switch ($type) {
            // 编辑按钮
            case 'edit':
                // 默认属性
                $btn_attribute = [
                    'title' => '编辑',
                    'icon'  => 'Hui-iconfont Hui-iconfont-edit',
                    'class' => 'btn btn-primary radius size-MINI',
                    'url'  => url(
                        $this->_module.'/'.$this->_controller.'/edit',
                        [
                            'id'          => '__id__',
                            'plugin_name' => $plugin_name
                        ]
                    ),
                    'target' => '_self'
                ];
                break;
            //更新按钮
            case 'update':
                // 默认属性
                $btn_attribute = [
                    'title' => '更新',
                    'icon'  => 'Hui-iconfont Hui-iconfont-huanyipi',
                    'class' => 'btn btn-success radius size-MINI',
                    'url'  => url(
                        $this->_module.'/'.$this->_controller.'/update',
                        [
                            'id'          => '__id__',
                            'plugin_name' => $plugin_name
                        ]
                    )
                ];
                break;
            // 启用按钮
            case 'enable':
                // 默认属性
                $btn_attribute = [
                    'title' => '启用',
                    'icon'  => 'Hui-iconfont Hui-iconfont-gouxuan2',
                    'class' => 'btn btn-success radius size-MINI',
                    'url'  => url(
                        $this->_module.'/'.$this->_controller.'/enable',
                        [
                            'ids'   => '__id__',
                            'table' => $table
                        ]
                    ),
                ];
                break;

            // 禁用按钮
            case 'disable':
                // 默认属性
                $btn_attribute = [
                    'title' => '禁用',
                    'icon'  => 'Hui-iconfont Hui-iconfont-shenhe-tingyong',
                    'class' => 'btn btn-warning radius size-MINI',
                    'url'  => url(
                        $this->_module.'/'.$this->_controller.'/disable',
                        [
                            'ids'   => '__id__',
                            'table' => $table
                        ]
                    ),
                ];
                break;

            // 删除按钮(不可恢复)
            case 'delete':
                // 默认属性
                $btn_attribute = [
                    'title' => '删除',
                    'icon'  => 'Hui-iconfont Hui-iconfont-del3',
                    'class' => 'btn btn-danger radius size-MINI',
                    'target-action'=>'delete',
                    'url'  => url(
                        $this->_module.'/'.$this->_controller.'/delete',
                        [
                            'ids'   => '__id__',
                            'table' => $table
                        ]
                    ),
                ];
                break;

            // 自定义按钮
            case 'custom':
                // 默认属性
                $btn_attribute = [
                    'title' => '自定义按钮',
                    'icon'  => 'Hui-iconfont Hui-iconfont-system',
                    'class' => 'btn btn-default radius size-MINI',
                    'url'  => 'javascript:void(0);'
                ];
                break;
        }

        // 合并自定义属性
        if ($attribute && is_array($attribute)) {
            $btn_attribute = array_merge($btn_attribute, $attribute);
        }

        // 是否为弹出框方式
        if ($pop) {
            $btn_attribute['eve'] = 'pop';
        }
        $this->_vars['right_buttons'][] = $btn_attribute;
        return $this;
    }

    /**
     * 一次性添加多个右侧按钮
     * @param array|string $buttons 按钮类型
     * 例如：
     * $builder->addRightButtons('edit');
     * $builder->addRightButtons('edit,delete');
     * $builder->addRightButtons(['edit', 'delete']);
     * $builder->addRightButtons(['edit' => ['table' => 'admin_user'], 'delete']);
     *
     * @return $this
     */
    public function addRightButtons($buttons = [])
    {
        if ($buttons) {
            $buttons = is_array($buttons) ? $buttons : explode(',', $buttons);
            foreach ($buttons as $key => $value) {
                if (is_numeric($key)) {
                    $this->addRightButton($value);
                } else {
                    $this->addRightButton($key, $value);
                }
            }
        }
        return $this;
    }

    /**
     * 编译HTML属性
     * @param array $attr 要编译的数据
     * @return array|string
     */
    private function compileHtmlAttr($attr = []) {
        $result = '';
        if ($attr) {
            foreach ($attr as $key => &$value) {
                if ($key == 'title') {
                    $value = trim(htmlspecialchars(strip_tags(trim($value))));
                } else {
                    $value = htmlspecialchars($value);
                }
                $result[] = "$key=\"$value\"";
            }
            $result = implode(' ', $result);
        }
        return $result;
    }

    /**
     * 替换右侧按钮
     * @param array $map 条件，格式为：['字段名' => '字段值', '字段名' => '字段值'....]
     * @param string $content 要替换的内容
     * @return $this
     */
    public function replaceRightButton($map = [], $content = '')
    {
        $this->_replace_right_buttons[] = [
            'map'     => $map,
            'content' => $content
        ];
        return $this;
    }

    /**
     * 添加额外的右侧按钮
     * @param array $map
     * @param string $content
     * @return $this
     */
    public function extraRightButton($map=[],$type='',$attribute=[],$pop = false){
        $this->_extra_right_buttons[] = [
            'map'=>$map,
            'type' =>$type,
            'attribute'=>$attribute,
            'pop'=>$pop
        ];
        return $this;
    }

    /**
     * 编译表格数据row_list的值
     */
    private function compileRows()
    {
        foreach ($this->_vars['row_list'] as $key => &$row) {
            // 编译右侧按钮
            if ($this->_vars['right_buttons']) {
                // 默认给列添加个空的右侧按钮
                if (!isset($row['right_button'])) {
                    $row['right_button'] = '';
                }
                // 如有替换右侧按钮，执行修改
                $_replace_button = false;
                if (!empty($this->_replace_right_buttons)) {
                    foreach ($this->_replace_right_buttons as $replace_right_button) {
                        // 是否能匹配到条件
                        $_button_match = true;
                        foreach ($replace_right_button['map'] as $field => $item) {
                            if(isset($row[$field])){
                              if(is_array($item)){
                                  if(!in_array($row[$field],$item)){
                                        $_button_match = false;
                                  }
                              }else{
                                  if ($row[$field] != $item) {
                                      $_button_match = false;
                                  }
                              }
                            }
                        }
                        if ($_button_match) {
                            $row['right_button'] = $replace_right_button['content'];
                            $_replace_button       = true;
                            break;
                        }
                    }
                }
                // 没有替换按钮，则按常规解析按钮url
                if (!$_replace_button) {
                    //若存在额外的右键按钮，补充额外按钮功能
                    if(!empty($this->_extra_right_buttons)){
                        foreach($this->_extra_right_buttons as $extra_right_button){
                            $_button_match = true;
                            foreach ($extra_right_button['map'] as $field => $item) {
                                if (isset($row[$field])) {
                                    if(is_array($item)){
                                        if(!in_array($row[$field],$item)){
                                            $_button_match = false;
                                        }
                                    }else{
                                        if ($row[$field] != $item) {
                                            $_button_match = false;
                                        }
                                    }
                                }
                            }
                            if ($_button_match) {
                                $this->addRightButton($extra_right_button['type'],$extra_right_button['attribute'],$extra_right_button['pop']);
                            }
                        }
                    }
                    //处理编译右键按钮
                    foreach ($this->_vars['right_buttons'] as $button_type => $button) {
                        // 处理主键变量值和表名变量值
                        $button['url'] = preg_replace(
                            ['/__id__/i','/__table__/i'],
                            [$row[$this->_vars['primary_key']],$this->_table_name],
                            $button['url']
                        );
                        //判断事件或链接
                        if(!isset($button['eve'])){
                            $button['href'] = $button['url'];
                        }else{
                            $button['href'] = 'javascript:;';
                        }
                        // 编译按钮属性
                        $button['attribute'] = $this->compileHtmlAttr($button);
                        $row['right_button'] .= '<a '.$button['attribute'].'><i class="'.$button['icon'].'"></i></a> ';
                    }
                }
            }

            // 编译单元格数据类型
            if ($this->_vars['columns']) {
                // 另外拷贝一份主键值，以免将主键设置为快速编辑的时候解析出错
                $row['_primary_key_value'] = $row[$this->_vars['primary_key']];
                foreach ($this->_vars['columns'] as $column) {
                    $_name       = $column['name'];
                    $_table_name = $this->_table_name;

                    // 判断是否有字段别名
                    if (strpos($column['name'], '|')) {
                        list($column['name'], $_name) = explode('|', $column['name']);
                        // 判断是否有表名
                        if (strpos($_name, '.')) {
                            list($_table_name, $_name) = explode('.', $_name);
                        }
                    }
                    switch ($column['type']) {
                        case 'link': // 链接
                            if ($column['default'] != '') {
                                // 要替换的字段名
                                $replace_to = [];
                                $pattern    = [];
                                $url        = $column['default'];
                                if (preg_match_all('/__(.*?)__/', $column['default'], $matches)) {
                                    foreach ($matches[1] as $match) {
                                        $pattern[] = '/__'. $match .'__/i';
                                        $replace_to[] = $row[$match];
                                    }
                                    $url = preg_replace(
                                        $pattern,
                                        $replace_to,
                                        $url
                                    );
                                }
                                //pop窗口或链接
                                if($column['param']&&$column['param']=='pop'){
                                    $row[$column['name']] = '<a url="'. $url .
                                        '" title="'. $row[$column['name']] .
                                        '" eve="pop" href="javascript:;">'.$row[$column['name']].'</a>';
                                }else{
                                    $row[$column['name']] = '<a href="'. $url .'"
                                    title="'. $row[$column['name']] .'"
                                    target="'.($column['param']?:'_self').'">'.$row[$column['name']].'</a>';
                                }
                            }
                            break;
                        case 'switch': // 开关
                            switch ($row[$column['name']]) {
                                case '0': // 关闭
                                    $row[$column['name']] = '<span class="layui-form" title="开启/关闭"><input type="checkbox" table="'.$this->_table_name.'" id="'.$row['_primary_key_value'].'" name="'.$column['name'].'" lay-filter="'.$column['name'].'" lay-skin="switch"></span>';
                                    break;
                                case '1': // 开启
                                    $row[$column['name']] = '<span class="layui-form" title="开启/关闭"><input type="checkbox" table="'.$this->_table_name.'" id="'.$row['_primary_key_value'].'" name="'.$column['name'].'" lay-filter="'.$column['name'].'" lay-skin="switch" checked></span>';
                                    break;
                            }
                            break;
                        case 'status': // 状态
                            switch ($row[$column['name']]) {
                                case '0': // 禁用
                                    $status_info = isset($column['param'][0]) ? $column['param'][0] : '禁用';
                                    $row[$column['name']] = '<span class="label radius">'.$status_info.'</span>';
                                    break;
                                case '1': // 启用
                                    $status_info = isset($column['param'][1]) ? $column['param'][1] : '启用';
                                    $row[$column['name']] = '<span class="label label-success radius">'.$status_info.'</span>';
                                    break;
                            }
                            break;
                        case 'yesno': // 是/否
                            switch ($row[$column['name']]) {
                                case '0': // 否
                                    $row[$column['name']] = '<span class="c-red"><i class="Hui-iconfont Hui-iconfont-close"></i></span>';
                                    break;
                                case '1': // 是
                                    $row[$column['name']] = '<span class="c-green"><i class="Hui-iconfont Hui-iconfont-gouxuan"></i></span>';
                                    break;
                            }
                            break;
                        case 'icon': // 图标
                            if ($row[$column['name']] === '') {
                                $row[$column['name']] = '<i class="Hui-iconfont '.$column['default'].'"></i>';
                            } else {
                                $row[$column['name']] = '<i class="Hui-iconfont '.$row[$column['name']].'"></i>';
                            }
                            break;
                        case 'byte': // 字节
                            if ($row[$column['name']] === '') {
                                $row[$column['name']] = $column['default'];
                            } else {
                                $row[$column['name']] = format_bytes($row[$column['name']], $column['param']);
                            }
                            break;
                        case 'date': // 日期
                        case 'datetime': // 日期时间
                        case 'time': // 时间
                            // 默认格式
                            $format = 'Y-m-d H:i';
                            if ($column['type'] == 'date')     $format = 'Y-m-d';
                            if ($column['type'] == 'datetime') $format = 'Y-m-d H:i';
                            if ($column['type'] == 'time')     $format = 'H:i';
                            // 格式
                            $format = $column['param'] == '' ? $format : $column['param'];
                            if ($row[$column['name']] == '') {
                                $row[$column['name']] = $column['default'];
                            } else {
                                $row[$column['name']] = format_time($row[$column['name']], $format);
                            }
                            break;
                        case 'picture': // 单张图片
                            $row[$column['name']] = '<a href="'.get_file_path($row[$column['name']]).'" target="_blank" title="'.get_file_name($row[$column['name']]).'"><img class="image" src="'.get_file_path($row[$column['name']]).'"></a>';
                            break;
                        case 'pictures': // 多张图片
                            if ($row[$column['name']] === '') {
                                $row[$column['name']] = !empty($column['default']) ? $column['default'] : '暂无图片';
                            } else {
                                $list_img = is_array($row[$column['name']]) ? $row[$column['name']] : explode(',', $row[$column['name']]);
                                $imgs = '';
                                foreach ($list_img as $key => $img) {
                                    if ($column['param'] != '' && $key == $column['param']) {
                                        break;
                                    }
                                    $imgs .= ' <a href="'.get_file_path($img).'" target="_blank" title="'.get_file_name($img).'"><img class="image" src="'.get_file_path($img).'"></a>';
                                }
                                $row[$column['name']] = $imgs;
                            }
                            break;
                        case 'callback': // 调用回调方法
                            if ($column['param'] == '') {
                                $params = [$row[$column['name']]];
                            } else if ($column['param'] === '__data__') {
                                $params = [$row[$column['name']], $row];
                            } else {
                                $params = [$row[$column['name']], $column['param']];
                            }
                            $row[$column['name']] = call_user_func_array($column['default'], $params);
                            break;
                        case 'text':
                        default: // 默认
                            if (!isset($row[$column['name']]) && !empty($column['default'])) {
                                $row[$column['name']] = $column['default'];
                            }
                            if (!empty($column['param'])) {
                                if (isset($column['param'][$row[$column['name']]])) {
                                    $row[$column['name']] = $column['param'][$row[$column['name']]];
                                }
                            }
                    }
                }
            }
        }
    }

    /**
     * 编译搜索框
     */
    private function compileSearch(){
        if(!empty($this->_vars['search'])){
            $this->_vars['search_info']['url'] = $this->_vars['search']['url'];//搜索表单url
            foreach($this->_vars['search']['fields'] as $name=>$field){
                switch ($field['type']){
                    case 'text'://普通文本框
                        $this->_vars['search_info']['fields'][] = $field['title'].'：<input type="text" class="input-text" style="width:150px" placeholder="'.
                            $field['placeholder'].'" id="id-'.$name.'" name="'.$name.'"/>';
                        break;
                }
            }
        }
    }

    /**
     * 编译表格数据
     */
    private function compileTable(){
        // 设置表名
        $this->_vars['_table'] = $this->_table_name;
        // 编译顶部按钮
        if ($this->_vars['top_buttons']) {
            foreach ($this->_vars['top_buttons'] as &$button) {
                // 处理表名变量值
                $button['url'] = preg_replace(
                    '/__table__/i',
                    $this->_table_name,
                    $button['url']
                );
                //判断弹出框或打开页面事件
                if(!isset($button['eve'])){
                    $button['href'] = $button['url'];
                }else{
                    $button['href'] = 'javascript:;';
                }
                $button['attribute'] = $this->compileHtmlAttr($button);
                $new_button = "<a {$button['attribute']}>";
                if (isset($button['icon']) && $button['icon'] != '') {
                    $new_button .= '<i class="'.$button['icon'].'"></i> ';
                }
                $new_button .= "{$button['title']}</a>";
                $button = $new_button;
            }
        }
        // 编译表格数据row_list的值
        $this->compileRows();
        //编译搜索框
        $this->compileSearch();
        // 处理页面标题
        if ($this->_vars['page_title'] == '') {
            $location = get_location();
            $curr_location = end($location);
            $this->_vars['page_title'] = $curr_location['title'];
        }

        // 处理是否有分页数据
        if (!$this->_has_pages) {
            $this->_vars['pages'] = '';
        }
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
        // 编译表格数据
        $this->compileTable();

        if ($template != '') {
            $this->_template = $template;
        }
        // 实例化视图并渲染
        return parent::fetch($this->_template, $this->_vars, $replace, $config);
    }

}