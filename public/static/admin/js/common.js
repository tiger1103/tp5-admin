/**
 * Created by yixiaohu on 2017/1/13.
 */
$(function(){
    layui.use(['layer','form'],function (layer,form) {
        $('.btn').click(function(){
            var $this = $(this);
            switch ($this.attr('eve')){
                case 'target':
                    var url = $this.attr('url');
                    if($this.attr('target-form')=='ids'){
                        var checkbox = $this.closest('.page-container').find('table>tbody input[name="ids[]"]:checked');
                        if(checkbox.length==0){
                            layer.alert('请选择要操作的数据',{icon:0,title:'提示'});
                            return;
                        }
                        var ids = [];
                        checkbox.each(function(i,v){
                            ids[i] = v.id;
                        });
                        if($this.attr('target-action')=='delete'){
                            layer.confirm('你确定要删除？',{icon:3},function(index){
                                layer.load();
                                url +='/ids/'+ids.join(',');
                                location.href = url;
                                layer.close(index);
                            });
                            return;
                        }
                        layer.load();
                        url +='/ids/'+ids.join(',');
                        location.href = url;
                    }else{
                        if($this.attr('target-action')=='delete') {
                            layer.confirm('你确定要删除？', {icon: 3}, function (index) {
                                layer.load();
                                location.href = url;
                                layer.close(index);
                            });
                            return;
                        }
                        layer.load();
                        location.href = url;
                    }
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
            var index = layer.load();
            var url = baseUrl+'/setStatus/ids/'+data.elem.id+'/action/'+(data.elem.checked?'enable':'disable');
            $.ajax({
                type: "GET",
                url: url,
                dataType: "json",
                cache: false,
                success:function(responseData){
                    if(responseData.code==1){
                        layer.msg(responseData.data);
                    }else{
                        layer.msg(responseData.data,{icon:5,shift:6});
                        window.setTimeout(function(){
                            data.elem.checked= data.elem.checked?false:true;
                            form().render('checkbox'); //更新
                        },300);
                    }
                },
                statusCode: {
                    404: function() {
                        layer.msg('请求失败',{icon:5,shift:6});
                    }
                },
                complete:function(){
                    layer.close(index);
                }
            });
        });
    });
});