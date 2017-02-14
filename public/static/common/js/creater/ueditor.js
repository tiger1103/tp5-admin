/**
 * Created by yixiaohu on 2017/2/10.
 */

$(function(){
    // ueditor编辑器
    $('.js-ueditor').each(function () {
        var ueditor_name = $(this).attr('name');
        ueditors[ueditor_name] = UE.getEditor(ueditor_name, {
            initialFrameHeight:320,  //初始化编辑器高度,默认320
            initialFrameWidth:'100%',
            serverUrl: ueditor_upload_url
        });
    });
});
