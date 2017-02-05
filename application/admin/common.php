<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2016/12/27
 * Time: 10:27
 */


/**
 * 数据签名认证
 * @param  array  $data 被认证的数据
 * @return string       签名
 * @author 麦当苗儿 <zuojiazi@vip.qq.com>
 */
function data_auth_sign($data) {
    //数据类型检测
    if (!is_array($data)) {
        $data = (array) $data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}


/**
 * 判断是否登录
 * @return int
 */
function isLogin(){
    $admin = session('user_auth');
    if (empty($admin)) {
        return 0;
    } else {
        return session('user_auth_sign') == data_auth_sign($admin) ? $admin['id'] : 0;
    }
}

if (!function_exists('format_time')) {
    /**
     * 时间戳格式化
     * @param null $time
     * @param string $format
     * @return false|string
     */
    function format_time($time = null, $format='Y-m-d H:i') {
        $time = $time === null ? time() : intval($time);
        return date($format, $time);
    }
}


if (!function_exists('get_nickname')) {
    /**
     * 根据用户ID获取用户昵称
     * @param  integer $uid 用户ID
     * @return string  用户昵称
     */
    function get_nickname($uid = 0)
    {
        static $list;
        // 获取当前登录用户名
        if (!($uid && is_numeric($uid))) {
            return session('user_auth.nickname');
        }
        // 获取缓存数据
        if (empty($list)) {
            $list = cache('sys_user_nickname_list');
        }
        // 查找用户信息
        $key = "u{$uid}";
        if (isset($list[$key])) {
            // 已缓存，直接使用
            $name = $list[$key];
        } else {
            $info =  model('admin/Admin')->field('nickname')->find($uid);
            if ($info !== false && $info->nickname) {
                $nickname = $info->nickname;
                $name = $list[$key] = $nickname;
                /* 缓存用户 */
                $count = count($list);
                $max   = config('user_max_cache');
                while ($count-- > $max) {
                    array_shift($list);
                }
                cache('sys_user_nickname_list', $list,null,'admin_admin');
            } else {
                $name = '';
            }
        }
        return $name;
    }
}


if (!function_exists('action_log')) {
    /**
     * 记录行为日志，并执行该行为的规则
     * @param null $action 行为标识
     * @param null $model 触发行为的模型名
     * @param string $record_id 触发行为的记录id
     * @param null $user_id 执行行为的用户id
     * @param string $details 详情
     * @return bool|string
     */
    function action_log($action = null, $model = null, $record_id = '', $user_id = null, $details = '')
    {
        // 参数检查
        if(empty($action) || empty($model)){
            return '参数不能为空';
        }

        if (strpos($action, '.')) {
            list($module, $action) = explode('.', $action);
        } else {
            $module = request()->module();
        }
        // 查询行为,判断是否执行
        $action_info = model('admin/Action')->where('module', $module)->getByName($action);
        if($action_info['status'] != 1){
            return '该行为被禁用或删除';
        }
        // 插入行为日志
        $data = [
            'action_id'   => $action_info['id'],
            'user_id'     => $user_id,
            'action_ip'   => request()->ip(1),
            'model'       => $model,
            'record_id'   => $record_id,
            'create_time' => request()->time()
        ];
        // 解析日志规则,生成日志备注
        if(!empty($action_info['log'])){
            if(preg_match_all('/\[(\S+?)\]/', $action_info['log'], $match)){
                $log = [
                    'user'    => $user_id,
                    'record'  => $record_id,
                    'model'   => $model,
                    'time'    => request()->time(),
                    'data'    => ['user' => $user_id, 'model' => $model, 'record' => $record_id, 'time' => request()->time()],
                    'details' => $details
                ];

                $replace = [];
                foreach ($match[1] as $value){
                    $param = explode('|', $value);
                    if(isset($param[1])){
                        $replace[] = call_user_func($param[1], $log[$param[0]]);
                    }else{
                        $replace[] = $log[$param[0]];
                    }
                }
                $data['remark'] = str_replace($match[0], $replace, $action_info['log']);
            }else{
                $data['remark'] = $action_info['log'];
            }
        }else{
            // 未定义日志规则，记录操作url
            $data['remark'] = '操作url：'.$_SERVER['REQUEST_URI'];
        }
        // 保存日志
        if(false==model('admin/Log')->validate(true)->isUpdate(false)->save($data)){
            return '行为日志写入失败：'.model('admin/Log')->getError();
        }

        if(!empty($action_info['rule'])){
            // 解析行为
            $rules = parse_action($action, $user_id);
            // 执行行为
            $res = execute_action($rules, $action_info['id'], $user_id);
            if (!$res) {
                return '执行行为失败';
            }
        }

        return true;
    }
}


if (!function_exists('parse_action')) {
    /**
     * 解析行为规则
     * 规则定义  table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
     * 规则字段解释：table->要操作的数据表，不需要加表前缀；
     *            field->要操作的字段；
     *            condition->操作的条件，目前支持字符串，默认变量{$self}为执行行为的用户
     *            rule->对字段进行的具体操作，目前支持四则混合运算，如：1+score*2/2-3
     *            cycle->执行周期，单位（小时），表示$cycle小时内最多执行$max次
     *            max->单个周期内的最大执行次数（$cycle和$max必须同时定义，否则无效）
     * 单个行为后可加 ； 连接其他规则
     * @param string $action 行为id或者name
     * @param int $self 替换规则里的变量为执行用户的id
     * @return boolean|array: false解析出错 ， 成功返回规则数组
     */
    function parse_action($action = null, $self){
        if(empty($action)){
            return false;
        }

        // 参数支持id或者name
        if(is_numeric($action)){
            $map = ['id' => $action];
        }else{
            $map = ['name' => $action];
        }

        // 查询行为信息
        $info = model('admin/Action')->where($map)->find();
        if(!$info || $info['status'] != 1){
            return false;
        }

        // 解析规则:table:$table|field:$field|condition:$condition|rule:$rule[|cycle:$cycle|max:$max][;......]
        $rule   = $info['rule'];
        $rule   = str_replace('{$self}', $self, $rule);
        $rules  = explode(';', $rule);
        $return = [];
        foreach ($rules as $key => &$rule){
            $rule = explode('|', $rule);
            foreach ($rule as $k => $fields){
                $field = empty($fields) ? array() : explode(':', $fields);
                if(!empty($field)){
                    $return[$key][$field[0]] = $field[1];
                }
            }
            // cycle(检查周期)和max(周期内最大执行次数)必须同时存在，否则去掉这两个条件
            if (!isset($return[$key]['cycle']) || !isset($return[$key]['max'])) {
                unset($return[$key]['cycle'],$return[$key]['max']);
            }
        }

        return $return;
    }
}



if (!function_exists('execute_action')) {
    /**
     * 执行行为
     * @param array|bool $rules 解析后的规则数组
     * @param int $action_id 行为id
     * @param array $user_id 执行的用户id
     * @return boolean false 失败 ， true 成功
     */
    function execute_action($rules = false, $action_id = null, $user_id = null){
        if(!$rules || empty($action_id) || empty($user_id)){
            return false;
        }

        $return = true;
        foreach ($rules as $rule){
            // 检查执行周期
            $map = ['action_id' => $action_id, 'user_id' => $user_id];
            $map['create_time'] = ['gt', request()->time() - intval($rule['cycle']) * 3600];
            $exec_count = model('admin/Log')->where($map)->count();
            if($exec_count > $rule['max']){
                continue;
            }

            // 执行数据库操作
            $field = $rule['field'];
            $res   = Db::name($rule['table'])->where($rule['condition'])->setField($field, array('exp', $rule['rule']));
            halt($res);
            if(!$res){
                $return = false;
            }
        }
        return $return;
    }
}

if (!function_exists('get_location')) {
    /**
     * 获取当前位置
     * @return mixed
     */
    function get_location()
    {
        $location = model('AuthRule')->getLocation();
        return $location;
    }
}


if (!function_exists('ck_js')) {
    /**
     * 返回ckeditor编辑器上传文件时需要返回的js代码
     * @param string $callback 回调
     * @param string $file_path 文件路径
     * @param string $error_msg 错误信息
     * @return string
     */
    function ck_js($callback = '', $file_path = '', $error_msg = '')
    {
        return "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction($callback, '$file_path' , '$error_msg');</script>";
    }
}