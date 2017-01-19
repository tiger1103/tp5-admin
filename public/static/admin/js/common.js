/**
 * Created by yixiaohu on 2017/1/13.
 */
$(function(){
    layui.use(['layer','form'],function (layer,form) {
        $('.btn').click(function(){
            var $this = $(this);
            switch ($this.attr('eve')){
                case 'target':
                    var index = layer.load();
                    var url = $this.attr('url');
                    location.href = url;
                    layer.close(index);
                    break;
                case 'pop':
                    var w=800,h=($(window).height() - 50),title,url;
                    w = $this.attr('pop-width')?$this.attr('pop-width'):w;
                    h = $this.attr('pop-height')?$this.attr('pop-height'):h;
                    title=$this.attr('pop-title')?$this.attr('pop-title'):$this.attr('title');
                    url=$this.attr('url');
                    layer.open({
                        type: 2,
                        area: [w+'px', h +'px'],
                        fix: false, //不固定
                        maxmin: true,
                        shade:0.4,
                        title: title,
                        content: url
                    });
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
