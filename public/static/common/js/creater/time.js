/**
 * Created by yixiaohu on 2017/2/10.
 */
$(function(){

    $('.timepicker-set').each(function () {
        var $this = $(this);
        var hh = $this.data('hh');
        var mm = $this.data('mm');
        $this.timepicki(
            {
                show_meridian:false,
                min_hour_value:0,
                max_hour_value:23,
                step_size_minutes:5,
                overflow_minutes:true,
                increase_direction:'up',
                disable_keyboard_mobile:false,
                reset: true,
                start_time: [hh, mm]
            }
        );
    });
});