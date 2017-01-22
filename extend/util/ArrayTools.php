<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/20
 * Time: 16:30
 */

namespace util;

/**
 * 数组处理工具类
 * @package util
 * @author yixiaohu
 */
class ArrayTools
{

    /**
     * 有层级关系的数组 ,将子级压入到父级（树形结构）
     * @param $data
     * @param $pid 父级id
     * @param string $fieldName 父idd的键名
     * @param string $id id的键名
     * @param string $filter 过滤键名
     * @param string $filterVal 过滤的值
     * @author yixiaohu
     * @return array
     */
    public static function pushSonToParent($data,$pid,$fieldName='pid',$id='id',$filter='',$filterVal='')
    {
        $menu = array();
        foreach($data as $k => $v)
        {
            if($v[$fieldName] == $pid)
            {
                if($filter!=''){
                    if($v[$filter]==$filterVal){
                        $v['son'] = self::pushSonToParent($data,$v[$id],$fieldName,$id,$filter,$filterVal);
                        $menu[] =$v;
                    }
                }else{
                    $v['son'] = self::pushSonToParent($data,$v[$id],$fieldName,$id,$filter,$filterVal);
                    $menu[] =$v;
                }
            }
        }
        return $menu;
    }

    /**
     * 有层级关系的数组,父级-》子级 排序
     * @param $data
     * @param int $pid 父级id值
     * @param int $flg 排序标签
     * @param string $fieldName 父id键名
     * @param string $id id键名
     * @author yixiaohu
     * @return array
     */
    public static function parentSonSort($data,$pid=0,$flg=1,$fieldName='pid',$id='id'){
        $arr = array();
        foreach($data as $k=>$v){
            if($pid==$v[$fieldName]){
                $v['flg']=$flg;
                $arr[]=$v;
                $arr2=self::parentSonSort($data,$v[$id],$flg+1,$fieldName,$id);
                $arr = array_merge($arr,$arr2);
            }
        }
        return $arr;
    }
    /**
     * 有层级关系的数组，通过父级id查找所有子级id数组
     * @param $arr 有层级关系的数组
     * @param int $fid 父级id值
     * @param string $flg 父级id键名
     * @param string $flgv 子级id键名
     * @return array 返回值
     * @author yixiaohu
     */
    public static function findSonByParentId($arr,$fid=0,$flg='fid',$flgv='id'){
        $arr1 = array();
        foreach($arr as $k=>$v){
            if($v[$flg]==$fid){
                $arr1[] = $v;
                $f = self::findSonByParentId($arr,$v[$flgv],$flg,$flgv);
                $arr1=array_merge($arr1,$f);
            }
        }
        return $arr1;
    }

    /**
     * 有层级关系的数组，通过子级fid查找所有父级数组
     * @param $arr 有层级关系的数组
     * @param $id 父id值
     * @param string $filter 额外过滤条件
     * @param string $fpid 父级id键名
     * @param  string $filter_value 过滤条件值
     * @return array
     * @author yixiaohu
     */
    public static function findParentBySonFid($arr,$id,$filter='filter',$fpid='pid',$filter_value=''){
        $arrs = array();
        foreach($arr as $k=>$v){
            if($v['id']==$id){
                if(isset($v[$filter])){
                    if($v[$filter]==$filter_value){
                        $arrs[]=$v;
                    }
                }else{
                    $arrs[]=$v;
                }
                $a = self::findParentBySonFid($arr,$v[$fpid],$filter,$fpid,$filter_value);
                $arrs=array_merge($arrs,$a);
            }
        }
        return $arrs;
    }

    /**
     * 获取最后一级
     * @param array $arr 一个有树形关系的数组
     * @param int $fid 父级id
     * @param string $flg 父级id具体字段
     * @param string $flgv 具体id字段信息
     * @author yixiaohu
     * @return array
     */
    public static function getEndChildren($arr,$fid=0,$flg='fid',$flgv='id'){
        $arr1 = array();
        foreach($arr as $k=>$v){
            if($v[$flg]==$fid){
                $arr1[] = $v[$flgv];
                $arr2 = self::getEndChildren($arr,$v[$flgv],$flg,$flgv);
                $count1 = count($arr2);
                $arr1 = array_merge($arr1,$arr2);
                $count2 = count($arr1);
                if($count1>0){
                    unset($arr1[$count2-$count1-1]);
                    $arr1 = array_values($arr1);
                }
            }
        }
        return $arr1;
    }

    /**
     * 根据父id查最后一级子级数量
     * @param array $arr 树形关系数组
     * @param int $fid 父级id
     * @param string $flg 父级id键名
     * @param string $flgv 子id键名
     * @author yixiaohu
     * @return int
     */
    public static function getLastChildNum($arr,$fid=0,$flg='fid',$flgv='id'){
        $count = 1;
        $targs = array();
        foreach($arr as $k=>$v){
            if($v[$flg]==$fid){
                if(!isset($targs[$v[$flg]])){
                    $targs[$v[$flg]] = 1;
                    $count -=1;
                }
                $count += self::getLastChildNum($arr,$v[$flgv],$flg,$flgv);
            }
        }
        return $count;
    }

    /**
     * 将数组的键用值替换
     * @param $arr
     * @return array
     * @author yixiaohu
     */
    public static function one2One($arr){
        $arr2=array();
        foreach($arr as $k=>$v){
            $arr2[$v]=$v;
        }
        return $arr2;
    }

    /**
     * 将数组的键用值替换生成二维数组
     * @param $arr
     * @param $key
     * @param $val
     * @param string $key2
     * @return array
     * @author yixiaohu
     */
    public static function manyToOne($arr,$key,$val='',$key2=''){
        $a=array();
        if($key2==''){
            if($val!=''){
                foreach($arr as $k=>$v){
                    $a[trim($v[$key])]=$v[$val];
                }
            }else{
                foreach($arr as $k=>$v){
                    $a[trim($v[$key])]=$v;
                }
            }
        }else{
            if($val!=''){
                foreach($arr as $k=>$v){
                    $k1 =trim($v[$key]);
                    $k2 = trim($v[$key2]);
                    $a[$k1][$k2] = $v[$val];
                }
            }else{
                foreach($arr as $k=>$v){
                    $k1 =trim($v[$key]);
                    $k2 = trim($v[$key2]);
                    $a[$k1][$k2] = $v;
                }
            }
        }
        return $a;
    }
}