/**
 * Created by yixiaohu on 2017/2/4.
 */


$(function(){
    // 百度地图
    $('.js-bmap').each(function () {
        var $self         = $(this);
        var map_canvas    = $self.find('.bmap').attr('id');
        var address       = $self.find('.bmap-address');
        var address_id    = address.attr('id');
        var map_point     = $self.find('.bmap-point');
        var search_result = $self.find('.searchResultPanel');
        var point_lng     = 103.804409;
        var point_lat     = 25.489153;
        var map_level     = $self.data('level');
        // 百度地图API功能
        var map = new BMap.Map(map_canvas);
        //开启鼠标滚轮缩放
        map.enableScrollWheelZoom(true);
        // 左上角，添加比例尺
        var top_left_control = new BMap.ScaleControl({anchor: BMAP_ANCHOR_TOP_LEFT});
        // 左上角，添加默认缩放平移控件
        var top_left_navigation = new BMap.NavigationControl();
        map.addControl(top_left_control);
        map.addControl(top_left_navigation);

        // 智能搜索
        var local = new BMap.LocalSearch(map, {
            onSearchComplete: function () {
                var point = local.getResults().getPoi(0).point;    //获取第一个智能搜索的结果
                map.centerAndZoom(point, 18);
                // 创建标注
                create_mark(point);
            }
        });

        // 创建标注
        var create_mark = function (point) {
            // 清空所有标注
            map.clearOverlays();
            var marker = new BMap.Marker(point);  // 创建标注
            map.addOverlay(marker);    //添加标注
            marker.setAnimation(BMAP_ANIMATION_BOUNCE); //跳动的动画
            // 写入坐标
            map_point.val(point.lng + "," + point.lat);
        };

        // 建立一个自动完成的对象
        var ac = new BMap.Autocomplete({
            "input" : address_id,
            "location" : map
        });
        // 鼠标放在下拉列表上的事件
        ac.addEventListener("onhighlight", function(e) {
            var str = "";
            var _value = e.fromitem.value;
            var value = "";
            if (e.fromitem.index > -1) {
                value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            }
            str = "FromItem<br />index = " + e.fromitem.index + "<br />value = " + value;

            value = "";
            if (e.toitem.index > -1) {
                _value = e.toitem.value;
                value = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            }
            str += "<br />ToItem<br />index = " + e.toitem.index + "<br />value = " + value;
            search_result.html(str);
        });


        // 鼠标点击下拉列表后的事件
        var myValue;
        ac.addEventListener("onconfirm", function(e) {
            var _value = e.item.value;
            myValue = _value.province +  _value.city +  _value.district +  _value.street +  _value.business;
            search_result.html("onconfirm<br />index = " + e.item.index + "<br />myValue = " + myValue);

            local.search(myValue);
        });

        // 监听点击地图时间
        map.addEventListener("click", function (e) {
            // 创建标注
            create_mark(e.point);
        });

        if (map_point.val() != '') {
            var curr_point = map_point.val().split(',');
            point_lng = curr_point[0];
            point_lat = curr_point[1];
            map_level = 16;
        } else if(address.val() != '') {
            local.search(address.val());
        } else {
            // 根据ip获取当前城市，并定位到当前城市
            var myCity = new BMap.LocalCity();
            myCity.get(function (result) {
                var cityName = result.name;
                map.setCenter(cityName);
            });
        }

        // 初始化地图,设置中心点坐标和地图级别
        var point = new BMap.Point(point_lng, point_lat);
        map.centerAndZoom(point, map_level);
        if (map_point.val() != '') {
            // 创建标注
            create_mark(point);
        }
    });
});

