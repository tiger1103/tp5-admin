/**
 * Created by yixiaohu on 2017/2/8.
 */


$(function(){
    // 图片裁剪
    $('.js-jcrop-interface').each(function () {
        var jcrop_api         = '';
        var $self             = $(this);
        var $jcrop            = $self.find('.js-jcrop');
        var $options          = $jcrop.data('options') || {};
        var $jcrop_cut_btn    = $self.find('.js-jcrop-cut-btn');
        var $jcrop_upload_btn = $self.find('.js-jcrop-upload-btn');
        var $jcrop_file       = $self.find('.js-jcrop-file');
        var $jcrop_cut_info   = $self.find('.js-jcrop-cut-info');
        var $jcrop_preview    = $self.find('.jcrop-preview');
        var $jcrop_input      = $self.find('.js-jcrop-input');
        var $remove_picture   = $self.find('.remove-picture');
        var $thumbnail        = $self.find('.thumbnail');
        var $img_link         = $self.find('.img-link');
        var $modal            = $self.find('.modal-popin');
        var $pic_height       = '';

        // 设置预览图监听
        $options.onChange    = showPreview;
        $options.onSelect    = showPreview;
        $options.boxWidth    = 750;
        $options.boxHeight   = 750;
        $options.saveWidth   = $options.saveWidth || null;
        $options.saveHeight  = $options.saveHeight || null;
        $options.aspectRatio = $options.aspectRatio || ($options.saveWidth / $options.saveHeight);

        // 点击上传按钮，选择图片
        $jcrop_upload_btn.click(function () {
            $jcrop_file.trigger('click');
        });

        // 加载图片（用于判断图片是否加载完毕）
        function loadImage(url, callback) {
            var img = new Image(); //创建一个Image对象，实现图片的预下载
            img.src = url;

            if(img.complete) { // 如果图片已经存在于浏览器缓存，直接调用回调函数
                callback.call(img);
                return; // 直接返回，不用再处理onload事件
            }
            img.onload = function () { //图片下载完毕时异步调用callback函数。
                callback.call(img);//将回调函数的this替换为Image对象
            };
        }

        // 实时显示预览图
        function showPreview(coords)
        {
            var ratio = coords.w / coords.h; // 选区比例
            var rx,ry;
            var preview_width  = '';
            var preview_height = '';

            if ((100 / ratio) > $pic_height) {
                preview_width  = $pic_height * ratio;
                preview_height = $pic_height;
            } else {
                preview_width  = 100;
                preview_height = 100 / ratio;
            }

            rx = preview_width / coords.w;
            ry = (preview_width / ratio) / coords.h;

            if (jcrop_api) {
                $jcrop_preview.css({
                    width: Math.round(rx * jcrop_api.ui.stage.width) + 'px',
                    height: Math.round(ry * jcrop_api.ui.stage.height) + 'px',
                    marginLeft: '-' + Math.round(rx * coords.x) + 'px',
                    marginTop: '-' + Math.round(ry * coords.y) + 'px'
                }).parent().css({
                    width: preview_width + 'px',
                    height: preview_height + 'px'
                });
            }

            var jcrop_info = [coords.w, coords.h, coords.x, coords.y, $options.saveWidth, $options.saveHeight];
            $jcrop_cut_info.val(jcrop_info.join(','));
        }

        // 选择图片后
        $jcrop_file.change(function () {
            var files = this.files;
            var file;
            if (files && files.length) {
                file = files[0];
                if (/^image\/\w+$/.test(file.type)) {
                    // 创建FormData对象
                    var data = new FormData();
                    // 为FormData对象添加数据
                    data.append('file', file);
                    layui.use('layer',function(){
                        var layer = layui.layer;
                        layer.load();
                    });
                    // 上传图片
                    $.ajax({
                        url: jcrop_upload_url,
                        type: 'POST',
                        cache: false,
                        contentType: false,    //不可缺
                        processData: false,    //不可缺
                        data: data,
                        success: function (res) {
                            if (res.code == 1) {
                                $jcrop.attr('src', res.src).data('id', res.id).show();
                                $jcrop_preview.attr('src', res.src).parent().show();
                                loadImage(res.src, function () {
                                    layui.use('layer',function(){
                                        var layer = layui.layer;
                                        layer.closeAll();
                                    });
                                    if (jcrop_api != '') {
                                        jcrop_api.destroy();
                                    }
                                    $jcrop.Jcrop($options, function () {
                                        jcrop_api   = this;
                                        $pic_height = Math.round(jcrop_api.getContainerSize()[1]);
                                        layui.use('layer',function(){
                                            layer = layui.layer;
                                            layer.open({
                                                type: 1,
                                                title:'图片裁剪',
                                                area:['1000px','600px'],
                                                shadeClose: false,
                                                content: $modal
                                            });
                                        });
                                    });
                                });
                            } else {
                                layui.use('layer',function(){
                                    var layer = layui.layer;
                                    layer.alert('上传失败，请重新上传',{icon: 2});
                                });
                            }
                        }
                    }).fail(function() {
                        layui.use('layer',function(){
                            var layer = layui.layer;
                            layer.closeAll();
                        });
                        layui.use('layer',function(){
                            var layer = layui.layer;
                            layer.alert('服务器错误~',{icon: 2});
                        });
                    });
                    $jcrop_file.val('');
                } else {
                    layui.use('layer',function(){
                        var layer = layui.layer;
                        layer.alert('请选择一张图片',{icon: 2});
                    });
                }
            }
        });

        // 关闭裁剪框
        $modal.on('hidden.bs.modal-jcrop', function (e) {
            $jcrop_cut_info.val('');
        });

        // 删除图片
        $remove_picture.click(function () {
            $(this).parent().hide();
            $jcrop_input.val('');
        });

        // 裁剪图片
        $jcrop_cut_btn.click(function () {
            var $cut_value = $jcrop_cut_info.val();
            if ($jcrop.attr('src') == '') {
                layui.use('layer',function(){
                    var layer = layui.layer;
                    layer.alert('请上传图片',{icon: 2});
                });
                return false;
            }
            if ($cut_value != '') {
                var $data = {
                    path: $jcrop_preview.attr('src'),
                    cut: $cut_value
                };
                layui.use('layer',function(){
                    var layer = layui.layer;
                    layer.load();
                });
                $.ajax({
                    url: jcrop_upload_url,
                    type: 'POST',
                    dataType: 'json',
                    data: $data
                })
                    .done(function(res) {
                        layui.use('layer',function(){
                            var layer = layui.layer;
                            layer.closeAll();
                        });
                        if (res.code == '1') {
                            $thumbnail.show().find('img').attr('src', res.thumb || res.src);
                            $jcrop_input.val(res.id);
                            $img_link.attr('href', res.src);
                            $jcrop_cut_info.val('');
                            layui.use('layer',function(){
                                var layer = layui.layer;
                                layer.closeAll();
                            });
                        } else {
                            layui.use('layer',function(){
                                var layer = layui.layer;
                                layer.alert(res.msg,{icon: 2});
                            });
                        }
                    })
                    .fail(function() {
                        layui.use('layer',function(){
                            var layer = layui.layer;
                            layer.closeAll();
                        });
                        layui.use('layer',function(){
                            var layer = layui.layer;
                            layer.alert('请求失败',{icon: 2});
                        });
                    });
            } else {
                layui.use('layer',function(){
                    var layer = layui.layer;
                    layer.alert('请选择要裁剪的大小',{icon: 2});
                });
            }
        });

        // 查看大图
        $(this).magnificPopup({
            delegate: 'a.img-link',
            type: 'image',
            gallery: {
                enabled: true
            }
        });

    });
});