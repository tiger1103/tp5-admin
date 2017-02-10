/**
 * Created by yixiaohu on 2017/2/10.
 */

$(function(){
    // 联动下拉框
    $('.select-linkage').change(function(){
        var self       = $(this), // 下拉框
            value      = self.val(), // 下拉框选中值
            ajax_url   = self.data('url'), // 异步请求地址
            param      = self.data('param'), // 参数名称
            next_items = self.data('next-items').split(','), // 下级下拉框的表单名数组
            next_item  = next_items[0]; // 下一级下拉框表单名

        // 下级联动菜单恢复默认
        if (next_items.length > 0) {
            for (var i = 0; i < next_items.length; i++) {
                $('select[name="'+ next_items[i] +'"]').html('<option value="">请选择：</option>');
            }
        }

        if (value != '') {
            layui.use('layer',function(){
                var layer = layui.layer;
                layer.load();
            });
            // 获取数据
            $.ajax({
                url: ajax_url,
                type: 'POST',
                dataType: 'json',
                data: param + "=" + value
            })
                .done(function(res) {
                    layui.use('layer',function(){
                        var layer = layui.layer;
                        layer.closeAll();
                    });
                    if (res.code == '1') {
                        var list = res.list;
                        if (list) {
                            for (var item in list) {
                                var option = $('<option></option>');
                                option.val(list[item].key).html(list[item].value);
                                $('select[name="'+ next_item +'"]').append(option);
                            }
                        }
                    } else {
                        layui.use('layer',function(){
                            var layer = layui.layer;
                            layer.alert(res.msg,{icon:2});
                        });
                    }
                })
                .fail(function() {
                    layui.use('layer',function(){
                        var layer = layui.layer;
                        layer.closeAll();
                    });
                    layui.use('layer',function(){
                        var layer = layui.layer;
                        layer.alert('数据请求失败',{icon:2});
                    });
                });
        }
    });
});
