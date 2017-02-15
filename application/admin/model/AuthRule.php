<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/16
 * Time: 14:42
 */

namespace app\admin\model;


class AuthRule extends Base
{
    /**
     * @var string 表名
     */
    protected $table = '__ADMIN_AUTH_RULE__';

    /**
     * @var array 自动完成
     */
    protected $auto = ['name','type','status'];

    protected $validate = [
        'rule'=>[
            'name'=>'require|unique:admin_auth_rule',
            'title' =>'require',
            'module'=>'require'
        ],
        'msg'=>[
            'name.require'=>'菜单url不能为空',
            'name.unique'=>'菜单url已经存在',
            'title' =>'菜单标题不能为空',
            'module'=>'模型信息分组名不能为空'
        ]
    ];

    public function setNameAttr($value){
        return strtolower($value);
    }
    public function setTypeAttr(){
        return 1;
    }
    public function setStatusAttr(){
        return 1;
    }

    /**
     * 更新规则
     * @param $data
     * @param $type
     * @return array
     */
    public function updateRule($data, $type){
        $data_rule = [];
        $i = 0;
        foreach ($data as $value) {
            $data_rule[$i] = array(
                'module' => $type,
                'name'   => $value['url'],
                'title'  => $value['title']
            );
            $id = $this->where(array('name' => $value['url']))->value('id');
            if ($id) {
                $data_rule[$i]['id'] = $id;
            }
            $i++;
        }
        if(false===$this->saveAll($data_rule)){
            return ['status'=>false,'msg'=>'权限规则更新失败：'.$this->getError()];
        }
        return ['status'=>true,'msg'=>'更新成功'];
    }

    /**
     * 获取路径名称
     * @param int $id
     * @param string $module
     * @param string $controller
     * @param string $action
     * @return array|mixed
     * @throws \think\Exception
     */
    public function getLocation($id=0,$module='',$controller='',$action=''){
        $module      = $module?:request()->module();
        $controller = $controller?:request()->controller();
        $action     = $action?:request()->action();

        $cache_name = 'location.'.$module.'_'.$controller.'_'.$action;
        $location   = cache($cache_name);

        if (!$location||config('APP_DEBUG')===true) {
            if($id!=0){
                $location = self::where('id',$id)->column('name,title');
            }else{
                $map['name'] = strtolower($module . '/' . $controller . '/' . $action);

                $location = self::where($map)->column('name,title');
            }
            if (empty($location)) {
                throw new \think\Exception('获取不到当前节点地址，可能未添加节点');
            }
            cache($cache_name, $location,get_cache_tag('admin_menu'));
        }
        return $location;
    }
}