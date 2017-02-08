/**
 * Created by yixiaohu on 2017/2/7.
 */

$(function(){
    // 文件上传
    $('.js-upload-file,.js-upload-files').each(function () {
        var $input_file       = $(this).find('input');
        var $input_file_name  = $input_file.attr('name');
        // 是否多文件上传
        var $multiple         = $input_file.data('multiple');
        // 允许上传的后缀
        var $ext              = $input_file.data('ext');
        // 文件限制大小
        var $size             = $input_file.data('size')*1024;
        // 文件列表
        var $file_list        = $('#file_list_' + $input_file_name);

        // 实例化上传
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // 去重
            duplicate: true,
            // swf文件路径
            swf: WebUploader_swf,
            // 文件接收服务端。
            server: file_upload_url,
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id: '#picker_' + $input_file_name,
                multiple: $multiple
            },
            // 文件限制大小
            fileSingleSizeLimit: $size,
            // 只允许选择文件文件。
            accept: {
                title: 'Files',
                extensions: $ext
            }
        });

        // 当有文件添加进来的时候
        uploader.on( 'fileQueued', function( file ) {
            var $li = '<li id="' + file.id + '" class="list-group-item file-item">' +
                '<span class="btn radius size-MINI" title="删除"><i class="Hui-iconfont Hui-iconfont-close2 remove-file"></i></span> ' +
                file.name +
                '<div class="progress-com progress-mini remove-margin active"><div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%"></div></div>'+
                '</li>';

            if ($multiple) {
                $file_list.append($li);
            } else {
                $file_list.html($li);
                // 清空原来的数据
                $input_file.val('');
            }
        });

        // 文件上传过程中创建进度条实时显示。
        uploader.on( 'uploadProgress', function( file, percentage ) {
            var $percent = $( '#'+file.id ).find('.progress-bar');
            $percent.css( 'width', percentage * 100 + '%' );
        });

        // 文件上传成功
        uploader.on( 'uploadSuccess', function( file, response ) {
            var $li = $( '#'+file.id );
            if (response.status == 1) {
                if ($multiple) {
                    if ($input_file.val()) {
                        $input_file.val($input_file.val() + ',' + response.id);
                    } else {
                        $input_file.val(response.id);
                    }
                    $li.find('.remove-file').attr('data-id', response.id);
                } else {
                    $input_file.val(response.id);
                }
            }
            // 加入提示信息
            $('<span class="text-'+ response.class +' pull-right">'+ response.info +'</span>').prependTo( $li );
        });

        // 文件上传失败，显示上传出错。
        uploader.on( 'uploadError', function( file ) {
            var $li = $( '#'+file.id );
            $('<span class="text-danger pull-right">上传失败</span>').prependTo( $li );
        });

        // 文件验证不通过
        uploader.on('error', function (type) {
            switch (type) {
                case 'Q_TYPE_DENIED':
                    layui.use('layer',function(){
                        var layer = layui.layer;
                        layer.alert('文件类型不正确，只允许上传后缀名为：'+$ext+'，请重新上传！',{icon: 2});
                    });
                    break;
                case 'F_EXCEED_SIZE':
                    layui.use('layer',function(){
                        var layer = layui.layer;
                        layer.alert('文件不得超过'+ ($size/1024) +'kb，请重新上传！',{icon: 2});
                    });
                    break;
            }
        });

        // 完成上传完了，成功或者失败，先删除进度条。
        uploader.on( 'uploadComplete', function( file ) {
            setTimeout(function(){
                $('#'+file.id).find('.progress-com').remove();
            }, 500);
        });

        // 删除文件
        $file_list.delegate('.remove-file', 'click', function(){
            if ($multiple) {
                var id  = $(this).data('id'),
                    ids = $input_file.val().split(',');

                if (id) {
                    for (var i = 0; i < ids.length; i++) {
                        if (ids[i] == id) {
                            ids.splice(i, 1);
                            break;
                        }
                    }
                    $input_file.val(ids.join(','));
                }
            } else {
                $input_file.val('');
            }
            $(this).closest('.file-item').remove();
        });
    });
});
