/**
 * Created by yixiaohu on 2017/2/5.
 */
$(function(){
    // Disable auto init when contenteditable property is set to true
    CKEDITOR.disableAutoInline = true;

    // Init inline text editor
    jQuery('.js-ckeditor-inlin').each(function () {
        var editor_id = $(this).attr('id');
        CKEDITOR.inline(editor_id);
    });

    // Init full text editor
    jQuery('.js-ckeditor').each(function () {
        var editor_id = $(this).attr('id');
        var editor    = CKEDITOR.replace(editor_id, {
            filebrowserImageUploadUrl: ckeditor_img_upload_url,
            filebrowserUploadUrl:ckeditor_file_upload_url,
            image_previewText: ' ',
            height: $(this).data('height') || 400,
            width: $(this).data('width') || '100%',
            toolbarCanCollapse: true
        });
        editor.on('change', function( evt ) {
            editor.updateElement();
        });
    });
});
