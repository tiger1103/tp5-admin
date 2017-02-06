/**
 * Created by yixiaohu on 2017/2/6.
 */

$(function(){
    layui.use('laydate', function(){
        var laydate = layui.laydate;
        $('.js-datepicker').click(function(){
            var elem = this;
            laydate({
                elem:elem,
                istoday: true,
                istime: true, //是否开启时间选择
                format: $(elem).data('date-format') //日期格式
            });
        });
    });
});