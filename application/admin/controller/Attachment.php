<?php
/**
 * Created by PhpStorm.
 * User: yixiaohu
 * Date: 2017/2/5
 * Time: 16:48
 */

namespace app\admin\controller;


use think\File;
use think\Image;
use app\admin\model\Attachment as AttachmentModel;

class Attachment extends Base
{
    /**
     * 上传附件
     * @param string $dir 保存的目录:images,files,videos,voices
     * @param string $from 来源，wangeditor：wangEditor编辑器, ueditor:ueditor编辑器, editormd:editormd编辑器等
     * @param string $module 来自哪个模块
     * @return \think\response\Json|void
     */
    public function upload($dir = '', $from = '', $module = '')
    {
        if ($dir == '')         return $this->error('没有指定上传目录');
        if ($from == 'ueditor') return $this->ueditor();
        if ($from == 'jcrop')   return $this->jcrop();
        return $this->saveFile($dir, $from, $module);
    }

    /**
     * 处理ueditor上传
     * @return string|\think\response\Json
     */
    private function ueditor(){
        $action      = $this->request->get('action');
        $config_file = BASE_PATH. '/static/admin/js/lib/ueditor/php/config.json';
        $config      = json_decode(preg_replace("/\/\*[\s\S]+?\*\//", "", file_get_contents($config_file)), true);
        switch ($action) {
            /* 获取配置信息 */
            case 'config':
                $result = $config;
                break;

            /* 上传图片 */
            case 'uploadimage':
                /* 上传涂鸦 */
            case 'uploadscrawl':
                return $this->saveFile('images', 'ueditor');
                break;

            /* 上传视频 */
            case 'uploadvideo':
                return $this->saveFile('videos', 'ueditor');
                break;

            /* 上传附件 */
            case 'uploadfile':
                return $this->saveFile('files', 'ueditor');
                break;

            /* 列出图片 */
            case 'listimage':
                return $this->showFile('listimage', $config);
                break;

            /* 列出附件 */
            case 'listfile':
                return $this->showFile('listfile', $config);
                break;
            default:
                $result = ['state' => '请求地址出错'];
                break;
        }

        /* 输出结果 */
        if (isset($_GET["callback"])) {
            if (preg_match("/^[\w_]+$/", $_GET["callback"])) {
                return htmlspecialchars($_GET["callback"]) . '(' . $result . ')';
            } else {
                return json(['state' => 'callback参数不合法']);
            }
        } else {
            return json($result);
        }
    }

    /**
     * 处理Jcrop图片裁剪
     */
    private function jcrop()
    {
        $file_path = $this->request->post('path', '');
        $cut_info  = $this->request->post('cut', '');
        $module    = $this->request->param('module', '');

        // 上传图片
        if ($file_path == '') {
            $file = $this->request->file('file');
            if (!is_dir(config('upload_temp_path'))) {
                mkdir(config('upload_temp_path'), 0766, true);
            }
            $info = $file->move(config('upload_temp_path'), $file->hash('md5'));
            if ($info) {
                return json(['code' => 1, 'src' => BASE_URL_PATH.'/'. 'uploads/temp/'. $info->getFilename()]);
            } else {
                $this->error('上传失败');
            }
        }

        $file_path = config('upload_temp_path') . str_replace(BASE_URL_PATH.'/'. 'uploads/temp/', '', $file_path);

        if (is_file($file_path)) {
            // 获取裁剪信息
            $cut_info  = explode(',', $cut_info);

            // 读取图片
            $image = Image::open($file_path);

            $dir_name = date('Ymd');
            $file_dir = config('upload_path') . DS . 'images/' . $dir_name . '/';
            if (!is_dir($file_dir)) {
                mkdir($file_dir, 0766, true);
            }
            $file_name     = md5(microtime(true)) . '.' . $image->type();
            $new_file_path = $file_dir . $file_name;

            // 裁剪图片
            $image->crop($cut_info[0], $cut_info[1], $cut_info[2], $cut_info[3], $cut_info[4], $cut_info[5])->save($new_file_path);

            // 水印功能
            if (config('upload_thumb_water') == 1 && config('upload_thumb_water_pic') > 0) {
                $this->create_water($new_file_path);
            }

            // 是否创建缩略图
            $thumb_path_name = '';
            if (config('upload_image_thumb') != '') {
                $thumb_path_name = $this->create_thumb($new_file_path, $dir_name, $file_name);
            }

            // 保存图片
            $file = new File($new_file_path);
            $file_info = [
                'uid'    => session('user_auth.id'),
                'name'   => $file_name,
                'mime'   => $image->mime(),
                'path'   => 'uploads/images/' . $dir_name . '/' . $file_name,
                'ext'    => $image->type(),
                'size'   => $file->getSize(),
                'md5'    => $file->hash('md5'),
                'sha1'   => $file->hash('sha1'),
                'thumb'  => $thumb_path_name,
                'module' => $module
            ];

            if ($file_add = AttachmentModel::create($file_info)) {
                // 删除临时图片
                unlink($file_path);
                // 返回成功信息
                return json([
                    'code'  => 1,
                    'id'    => $file_add['id'],
                    'src'   => BASE_URL_PATH.'/' . $file_info['path'],
                    'thumb' => $thumb_path_name == '' ? '' : BASE_URL_PATH.'/' . $thumb_path_name,
                ]);
            } else {
                $this->error('上传失败');
            }
        }
        $this->error('文件不存在');
    }

    /**
     * 保存附件
     * @param string $dir 附件存放的目录
     * @param string $from 来源
     * @param string $module 来自哪个模块
     * @return string|\think\response\Json
     */
    private function saveFile($dir = '', $from = '', $module = '')
    {
        // 附件大小限制
        $size_limit = $dir == 'images' ? config('upload_image_size') : config('upload_file_size');
        $size_limit = $size_limit * 1024 * 1024;
        // 附件类型限制
        $ext_limit = $dir == 'images' ? config('upload_image_ext') : config('upload_file_ext');
        $ext_limit = $ext_limit != '' ? parse_attr($ext_limit) : '';
        // 获取附件数据
        switch ($from) {
            case 'editormd':
                $file_input_name = 'editormd-image-file';
                break;
            case 'ckeditor':
                $file_input_name = 'upload';
                $callback = $this->request->get('CKEditorFuncNum');
                break;
            default:
                $file_input_name = 'file';
        }
        $file = $this->request->file($file_input_name);

        // 判断附件是否已存在
        if ($file_exists = AttachmentModel::get(['md5' => $file->hash('md5')])) {
            $file_path = BASE_URL_PATH.'/'. $file_exists['path'];
            switch ($from) {
                case 'wangeditor':
                    config('app_trace',false);
                    return $file_path;
                    break;
                case 'ueditor':
                    return json([
                        "state" => "SUCCESS",          // 上传状态，上传成功时必须返回"SUCCESS"
                        "url"   => $file_path, // 返回的地址
                        "title" => $file_exists['name'], // 附件名
                    ]);
                    break;
                case 'editormd':
                    return json([
                        "success" => 1,
                        "message" => '上传成功',
                        "url"     => $file_path,
                    ]);
                    break;
                case 'ckeditor':
                    return ck_js($callback, $file_path);
                    break;
                default:
                    return json([
                        'status' => 1,
                        'info'   => '上传成功',
                        'class'  => 'success',
                        'id'     => $file_exists['id'],
                        'path'   => $file_path
                    ]);
            }
        }

        // 判断附件大小是否超过限制
        if ($size_limit > 0 && ($file->getInfo('size') > $size_limit)) {
            switch ($from) {
                case 'wangeditor':
                    return "error|附件过大";
                    break;
                case 'ueditor':
                    return json(['state' => '附件过大']);
                    break;
                case 'editormd':
                    return json(["success" => 0, "message" => '附件过大']);
                    break;
                case 'ckeditor':
                    return ck_js($callback, '', '附件过大');
                    break;
                default:
                    return json([
                        'status' => 0,
                        'class'  => 'danger',
                        'info'   => '附件过大'
                    ]);
            }
        }

        // 判断附件格式是否符合
        $file_name = $file->getInfo('name');
        $file_ext  = substr($file_name, strrpos($file_name, '.')+1);
        $error_msg = '';
        if ($ext_limit == '') {
            $error_msg = '获取文件信息失败！';
        }
        if ($file->getMime() == 'text/x-php' || $file->getMime() == 'text/html') {
            $error_msg = '禁止上传非法文件！';
        }
        if (!in_array($file_ext, $ext_limit)) {
            $error_msg = '附件类型不正确！';
        }
        if ($error_msg != '') {
            switch ($from) {
                case 'wangeditor':
                    return "error|{$error_msg}";
                    break;
                case 'ueditor':
                    return json(['state' => $error_msg]);
                    break;
                case 'editormd':
                    return json(["success" => 0, "message" => $error_msg]);
                    break;
                case 'ckeditor':
                    return ck_js($callback, '', $error_msg);
                    break;
                default:
                    return json([
                        'status' => 0,
                        'class'  => 'danger',
                        'info'   => $error_msg
                    ]);
            }
        }

        // 移动到框架应用根目录/uploads/ 目录下
        $info = $file->move(config('upload_path') . DS . $dir);

        if($info){
            // 水印功能
            if ($dir == 'images' && config('upload_thumb_water') == 1 && config('upload_thumb_water_pic') > 0) {
                $this->create_water($info->getRealPath());
            }

            // 缩略图路径
            $thumb_path_name = '';
            // 生成缩略图
            if ($dir == 'images' && config('upload_image_thumb') != '') {
                $thumb_path_name = $this->create_thumb($info, $info->getPathInfo()->getfileName(), $info->getFilename());
            }

            // 获取附件信息
            $file_info = [
                'uid'    => session('user_auth.id'),
                'name'   => $file->getInfo('name'),
                'mime'   => $file->getInfo('type'),
                'path'   => 'uploads/' . $dir . '/' . str_replace('\\', '/', $info->getSaveName()),
                'ext'    => $info->getExtension(),
                'size'   => $info->getSize(),
                'md5'    => $info->hash('md5'),
                'sha1'   => $info->hash('sha1'),
                'thumb'  => $thumb_path_name,
                'module' => $module
            ];

            // 写入数据库
            if ($file_add = AttachmentModel::create($file_info)) {
                $file_path = BASE_URL_PATH.'/'. $file_info['path'];
                switch ($from) {
                    case 'wangeditor':
                        return $file_path;
                        break;
                    case 'ueditor':
                        return json([
                            "state" => "SUCCESS",          // 上传状态，上传成功时必须返回"SUCCESS"
                            "url"   => $file_path, // 返回的地址
                            "title" => $file_info['name'], // 附件名
                        ]);
                        break;
                    case 'editormd':
                        return json([
                            "success" => 1,
                            "message" => '上传成功',
                            "url"     => $file_path,
                        ]);
                        break;
                    case 'ckeditor':
                        return ck_js($callback, $file_path);
                        break;
                    default:
                        return json([
                            'status' => 1,
                            'info'   => '上传成功',
                            'class'  => 'success',
                            'id'     => $file_add['id'],
                            'path'   => $file_path
                        ]);
                }
            } else {
                switch ($from) {
                    case 'wangeditor':
                        return "error|上传失败";
                        break;
                    case 'ueditor':
                        return json(['state' => '上传失败']);
                        break;
                    case 'editormd':
                        return json(["success" => 0, "message" => '上传失败']);
                        break;
                    case 'ckeditor':
                        return ck_js($callback, '', '上传失败');
                        break;
                    default:
                        return json(['status' => 0, 'class' => 'danger', 'info' => '上传失败']);
                }
            }
        }else{
            switch ($from) {
                case 'wangeditor':
                    return "error|".$file->getError();
                    break;
                case 'ueditor':
                    return json(['state' => '上传失败']);
                    break;
                case 'editormd':
                    return json(["success" => 0, "message" => '上传失败']);
                    break;
                case 'ckeditor':
                    return ck_js($callback, '', '上传失败');
                    break;
                default:
                    return json(['status' => 0, 'class' => 'danger', 'info' => $file->getError()]);
            }
        }
    }

    /**
     * 显示附件列表（ueditor）
     * @param string $type 类型
     * @param $config
     * @return \think\response\Json
     */
    private function showFile($type = '', $config){
        /* 判断类型 */
        switch ($type) {
            /* 列出附件 */
            case 'listfile':
                $allowFiles = $config['fileManagerAllowFiles'];
                $listSize = $config['fileManagerListSize'];
                $path = realpath(config('upload_path') .'/files/');
                break;
            /* 列出图片 */
            case 'listimage':
            default:
                $allowFiles = $config['imageManagerAllowFiles'];
                $listSize = $config['imageManagerListSize'];
                $path = realpath(config('upload_path') .'/images/');
        }
        $allowFiles = substr(str_replace(".", "|", join("", $allowFiles)), 1);

        /* 获取参数 */
        $size = isset($_GET['size']) ? htmlspecialchars($_GET['size']) : $listSize;
        $start = isset($_GET['start']) ? htmlspecialchars($_GET['start']) : 0;
        $end = $start + $size;

        /* 获取附件列表 */
        $files = $this->getfiles($path, $allowFiles);
        if (!count($files)) {
            return json(array(
                "state" => "no match file",
                "list" => array(),
                "start" => $start,
                "total" => count($files)
            ));
        }

        /* 获取指定范围的列表 */
        $len = count($files);
        for ($i = min($end, $len) - 1, $list = array(); $i < $len && $i >= 0 && $i >= $start; $i--){
            $list[] = $files[$i];
        }

        /* 返回数据 */
        $result = array(
            "state" => "SUCCESS",
            "list"  => $list,
            "start" => $start,
            "total" => count($files)
        );

        return json($result);
    }

    /**
     * 遍历获取目录下的指定类型的附件
     * @param string $path 路径
     * @param string $allowFiles 允许查看的类型
     * @param array $files 文件列表
     * @return array|null
     */
    public function getfiles($path = '', $allowFiles = '', &$files = array())
    {
        if (!is_dir($path)) return null;
        if(substr($path, strlen($path) - 1) != '/') $path .= '/';
        $handle = opendir($path);
        while (false !== ($file = readdir($handle))) {
            if ($file != '.' && $file != '..') {
                $path2 = $path . $file;
                if (is_dir($path2)) {
                    $this->getfiles($path2, $allowFiles, $files);
                } else {
                    if (preg_match("/\.(".$allowFiles.")$/i", $file)) {
                        $files[] = array(
                            'url'=> str_replace("\\", "/", substr($path2, strlen($_SERVER['DOCUMENT_ROOT']))),
                            'mtime'=> filemtime($path2)
                        );
                    }
                }
            }
        }
        return $files;
    }

    /**
     * 添加水印
     * @param string $file 要添加水印的文件路径
     */
    private function create_water($file = '')
    {
        $thumb_water_pic = realpath(config('upload_path').'/..'. get_file_path(config('upload_thumb_water_pic')));
        // 读取图片
        $image = Image::open($file);
        // 添加水印
        $image->water($thumb_water_pic, config('upload_thumb_water_position'), config('upload_thumb_water_alpha'));
        // 保存水印图片，覆盖原图
        $image->save($file);
    }

    /**
     * 创建缩略图
     * @param string $file 目标文件，可以是文件对象或文件路径
     * @param string $dir 保存目录，即目标文件所在的目录名
     * @param string $save_name 缩略图名
     * @return string 缩略图路径
     */
    private function create_thumb($file = '', $dir = '', $save_name = '')
    {
        // 获取要生成的缩略图最大宽度和高度
        list($thumb_max_width, $thumb_max_height) = explode(',', config('upload_image_thumb'));
        // 读取图片
        $image = Image::open($file);
        // 生成缩略图
        $image->thumb($thumb_max_width, $thumb_max_height, config('upload_image_thumb_type'));
        // 保存缩略图
        $thumb_path = config('upload_path') . DS . 'images/' . $dir . '/thumb/';
        if (!is_dir($thumb_path)) {
            mkdir($thumb_path, 0766, true);
        }
        $thumb_path_name = $thumb_path. $save_name;
        $image->save($thumb_path_name);
        $thumb_path_name = 'uploads/images/' . $dir . '/thumb/' . $save_name;
        return $thumb_path_name;
    }
}