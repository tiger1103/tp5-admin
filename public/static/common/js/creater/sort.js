/**
 * Created by yixiaohu on 2017/2/9.
 */

$(function(){
    // 排序
    $('.nestable').each(function () {
        $(this).nestable({maxDepth:1}).on('change', function(){
            var $items = $(this).nestable('serialize');
            var name = $(this).data('name');
            var value = [];
            for (var item in $items) {
                value.push($items[item].id);
            }
            if (value.length) {
                $('input[name='+name+']').val(value.join(','));
            }
        });
    });
});
