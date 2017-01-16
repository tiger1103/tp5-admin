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
     * @var string 模型名
     */
    protected $name = 'admin_auth_rule';

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
        return 2;
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
        $data_rule = [
            ['module' => 'admin','name'   => 'sasdasdxxxasdasdasd','title'  => '标题'],
            ['id'=>2,'module' => 'admin','name'   => 'asdasdasd','title'  => '标题'],
        ];
        if(false===$this->saveAll($data_rule)){
            return ['status'=>false,'msg'=>'权限规则更新失败：'.$this->getError()];
        }
        return ['status'=>true,'msg'=>'更新成功'];
    }

}