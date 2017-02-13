/**
 * Created by yixiaohu on 2017/2/13.
 */
$(function(){

    // 多级联动下拉框
    $('.select-linkages').change(function () {
        var self       = $(this), // 下拉框
            value      = self.val(), // 下拉框选中值
            table      = self.data('table'), // 数据表
            key        = self.data('key') || 'id',
            pidkey     = self.data('pidkey') || 'pid',
            option     = self.data('option') || 'name',
            next_level = self.data('next-level'), // 下一级别
            next_level_id = self.data('next-level-id') || ''; // 下一级别的下拉框id

        // 下级联动菜单恢复默认
        if (next_level_id != '') {
            $('#' + next_level_id).html('<option value="">请选择：</option>');
            var has_next_level = $('#' + next_level_id).data('next-level-id');
            if (has_next_level) {
                $('#' + has_next_level).html('<option value="">请选择：</option>');
                has_next_level = $('#' + has_next_level).data('next-level-id');
                if (has_next_level) {
                    $('#' + has_next_level).html('<option value="">请选择：</option>');
                }
            }
        }

        if (value != '') {
            layui.use('layer',function(){
                var layer = layui.layer;
                layer.load();
            });
            // 获取数据
            $.ajax({
                url: get_level_data,
                type: 'POST',
                dataType: 'json',
                data: {
                    table: table,
                    level: next_level,
                    pid: value,
                    key: key,
                    pidkey: pidkey,
                    option: option
                }
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
                                option.val(list[item].key).text(list[item].value);
                                $('#' + next_level_id).append(option);
                            }
                        }
                    } else {
                        layui.use('layer',function(){
                            var layer = layui.layer;
                            layer.closeAll();
                        });
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
