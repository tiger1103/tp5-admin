/**
 * Created by yixiaohu on 2017/2/9.
 */
$(function(){
    $('.js-tags-input').tagsInput({
        height: '36px',
        width: '100%',
        defaultText: '添加标签',
        removeWithBackspace: true,
        delimiter: [',']
    });
});
