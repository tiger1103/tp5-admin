/**
 * Created by yixiaohu on 2017/2/13.
 */

$(function(){
    // 格式文本
    $('.js-masked').each(function () {
        var $format = $(this).data('format') || '';
        $(this).mask($format);
    });
});
