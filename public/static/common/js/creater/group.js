/**
 * Created by yixiaohu on 2017/2/13.
 */

$(function(){
    $('.group-select li').click(function(){
        var $this = $(this);
        var $parent = $this.parent();
        $parent.children('li').each(function(i,v){
            $(v).removeClass('active');
        });
        $this.addClass('active');
        var id = $this.data('id');
        $parent.next().children('div').each(function(i,v){
            if($(v).attr('id')==id){
                $(v).removeClass('tab-pane').addClass('active');
            }else{
                $(v).removeClass('active').addClass('tab-pane');
            }
        });
    });
});