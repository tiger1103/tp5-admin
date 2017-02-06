/**
 * Created by yixiaohu on 2017/2/6.
 */

$(function () {
    // editormd编辑器
    $('.js-editormd').each(function () {
        var editormd_name = $(this).attr('name');
        var image_formats = $(this).data('image-formats') || [];
        var watch         = $(this).data('watch');

        editormds[editormd_name] = editormd(editormd_name, {
            height: 500, // 高度
            placeholder: '请输入内容',
            watch : watch,
            searchReplace : true,
            toolbarAutoFixed: false, // 取消工具栏固定
            path : editormd_mudule_path, // 用于自动加载其他模块
            codeFold: true, // 开启代码折叠
            dialogLockScreen : false, // 设置弹出层对话框不锁屏
            imageUpload : true, // 开启图片上传
            imageFormats : image_formats, // 允许上传的图片后缀
            imageUploadURL : editormd_upload_url,
            toolbarIcons : function() {
                return [
                    "undo", "redo", "|",
                    "bold", "del", "italic", "quote", "|",
                    "h1", "h2", "h3", "h4", "h5", "h6", "|",
                    "list-ul", "list-ol", "hr", "|",
                    "link", "reference-link", "image", "code", "preformatted-text", "code-block", "datetime", "html-entities", "pagebreak", "|",
                    "goto-line", "watch", "preview", "fullscreen", "clear", "search", "|",
                    "help", "info"
                ]
            }
        });
    });
});
