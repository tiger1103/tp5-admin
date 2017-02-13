/**
 * Created by yixiaohu on 2017/2/13.
 */

$(function(){
    $('.js-rangeslider').each(function(){
        var $input = $(this);

        $input.ionRangeSlider({
            input_values_separator: ';'
        });
    });
});
