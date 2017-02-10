/**
 * Created by yixiaohu on 2017/2/10.
 */
$(function(){
    // wangeditor编辑器
    $('.js-wangeditor').each(function () {
        var wangeditor_name = $(this).attr('name');
        var imgExt = $(this).data('img-ext') || '';

        // 关闭调试信息
        wangEditor.config.printLog = false;
        // 实例化编辑器
        wangeditors[wangeditor_name] = new wangEditor(wangeditor_name);
        // 上传图片地址
        wangeditors[wangeditor_name].config.uploadImgUrl = wangeditor_upload_url;
        // 允许上传图片后缀
        wangeditors[wangeditor_name].config.imgExt = imgExt;
        // 配置文件名
        wangeditors[wangeditor_name].config.uploadImgFileName = 'file';
        // 去掉地图
        wangeditors[wangeditor_name].config.menus = $.map(wangEditor.config.menus, function(item, key) {
            if (item === 'location') {
                return null;
            }
            return item;
        });
        // 添加表情
        wangeditors[wangeditor_name].config.emotions = {
            'default': {
                title: '默认',
                data: wangeditor_emotions
            }
        };
        wangeditors[wangeditor_name].create();
    });
});
