/**
 * Created by seroj on 11/24/14.
 */

$(document).ready(function() {
    $('#btn-go').click(function(event) {
        event.preventDefault();
        $('#myModal').modal('hide');
        $chk = $('.chk:checked').map(function() {return this.value;}).get().join(',');
        $wa = $('#weight_air').val();
        $we = $('#weight_earthquake').val();
        $wc = $('#weight_crime').val();
        $regNE = $('#rect1').val();
        $regSW = $('#rect2').val();
        $.ajax({
            url:  '/heat_map/go',
            type: 'POST',
            data: {filter:$chk, wa:$wa, we:$we, wc:$wc, ne:$regNE, sw:$regSW},
            success: function(result) {
                $('#panel-right').show();
                redraw(result.out);
            }
        });
    });
});
