<?php
namespace app\index\controller;
use think\Config;
use think\captcha\Captcha;
use think\Controller;
use think\Url;

class Index extends Controller
{
    public function index($id='')
    {
        return $this->fetch('index',['name'=>'yxh']);
    }



}
