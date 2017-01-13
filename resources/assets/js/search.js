/**
 * Created by Rowan on 7-1-2017.
 */
$( document ).ready(function() {
    $('#searchbox').click(function(){
        $('.search_overlay').addClass('hidden');
    });
    $('.search_overlay').click(function(){
        $('.search_overlay').addClass('hidden');
    });

    $(window).keypress(function(e) {
        var code = (e.keyCode ? e.keyCode : e.which);
        $('#searchbox').focus();
                $('.search_overlay').addClass('hidden');
        if(code == 13) { //Enter keycode
            $('#searchForm').submit();
        }
    });
});