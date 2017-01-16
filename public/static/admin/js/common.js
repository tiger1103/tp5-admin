/**
 * Created by yixiaohu on 2017/1/13.
 */
$(function(){
    layui.use(['layer','form'],function (layer,form) {
        $('.btn').click(function(){
            var $this = $(this);
            layer.load();
            switch ($this.attr('eve')){
                case 'target':
                    url = $this.attr('url');
                    location.href = url;
                    break;
            }
        });

        //状态设置
        form().on('switch(status)',function(data){
            
            console.log(data.elem); //得到checkbox原始DOM对象
            console.log(data.elem.checked); //开关是否开启，true或者false
            console.log(data.value); //开关value值，也可以通过data.elem.value得到
        });
    });
});
