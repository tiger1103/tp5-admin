<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/1/3
 * Time: 15:53
 */

namespace app\common\behavior;


use lib\Storage;

class InitConfig
{
    public function run(&$params){
        // 初始化文件存储方式
        Storage::connect('File');
    }
}