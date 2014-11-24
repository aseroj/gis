/**
 * Created by seroj on 11/24/14.
 */

$(document).ready(function() {
    $('#btn-go').click(function(event) {
        event.preventDefault();
        $chk = $('.chk:checked').map(function() {return this.value;}).get().join(',');
        $.ajax({
            url:  '/heat_map/go',
            type: 'POST',
            data: {filter:$chk},
            success: function(result) {
                //console.log(result.out);
                //mapData(result.out);
                redraw(result.out);
            }
        });
    });
});
