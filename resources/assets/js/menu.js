/**
 * Created by Rowan on 27-12-2016.
 */

$( document ).ready(function() {
    var collapsed = false;
    var minClass = '#minPrice';
    var maxClass = '#maxPrice';
    var minPrice = $(minClass).val();
    var maxPrice = $(maxClass).val();
    $( "#slider-range" ).slider({
        range: true,
        min: 0,
        max: 800,
        values: [ minPrice, maxPrice ],
        slide: function( event, ui ) {
            $(minClass).val(ui.values[ 0 ]);
            $(maxClass).val(ui.values[ 1 ]);
        },
        change: function(event, ui) {
            $("#filterForm").submit();
        }
    });



/*    $('#create_spec_nl').click(function(){
        $('.spec_section_nl:first').clone().appendTo('.create_specifications_nl');
    });
    $('#create_color_nl').click(function(){
        $('.color_section_nl:first').clone().appendTo('.create_colors_nl');
    });*/
    $('#create_spec_nl').click(function(){
        $('.spec_section_nl:first').clone().appendTo('.create_specifications_nl');
    });
    $('#create_color').click(function(){
        $('.color_section:first').clone().appendTo('.create_colors');
    });
    $('#create_spec_en').click(function(){
        $('.spec_section_en:first').clone().appendTo('.create_specifications_en');
    });
 /*   $('#create_color_en').click(function(){
        $('.color_section_en:first').clone().appendTo('.create_colors_en');
    });*/













    $('.filter_collapse p').click(function(){

        if( $('.filter_collapse_content').hasClass('hidden')){
            $('.filter_collapse p span').html('&#9660;');

            $('.filter_collapse_content').removeClass('hidden');
        }else{
            $('.filter_collapse p span').html('&#9654;');

            $('.filter_collapse_content').addClass('hidden');
        }
    });
/*   var activeClass = loc alStorage.getItem('active');
    $('.' + activeClass).addClass('active');

    $('.animals a').click(function(){
        $('.animals a').removeClass('active');
        $(this).addClass('active');
        localStorage.setItem('active', $(this).attr('class'));
    });*/
   /* $('input').on('click',(function(){
        document.getElementById('filter').submit();
    }));*/
        if(  $('.wrapper-dropdown div').hasClass('has_old')){
            if($('#order_by').val() != ' default '){
                var activeElement = '#'+$('#order_by').val();
                $('.wrapper-dropdown div').html($(activeElement).html());
            }

        }

    $('.wrapper-dropdown div').click(function(){

        if( $('.wrapper-dropdown ul').hasClass('hidden')){
            $('.wrapper-dropdown ul').removeClass('hidden');
        }else{
            $('.wrapper-dropdown ul').addClass('hidden');
        }
    });


    $('.wrapper-dropdown li').click(function(){
        $('#order_by').val($(this).attr('id'));
        $('.wrapper-dropdown div').html($(this).html());
        $('.wrapper-dropdown ul').addClass('hidden');
        $('#filterForm').submit();
    });

   $('.navBurger').click(function(){
       if(!collapsed){
           $('#sideNav').removeClass('sideNavMin');
           $('#sideNav').addClass('sideNavCollapsed');

           $('#navFooter').removeClass('navFooterMin');
           $('#navFooter').addClass('navFooterCollapsed');
           $('#navLogo').removeClass('sprite-kownloon_single');
           $('#navLogo').addClass('sprite-kowloon-logo');
           $('.icon-text-animal').removeClass('hidden');
           $('.icon-text-help').removeClass('hidden');

           collapsed = true;
       }else{
           $('.icon-text-animal').addClass('hidden');
           $('.icon-text-help').addClass('hidden');
           $('#sideNav').removeClass('sideNavCollapsed');
           $('#sideNav').addClass('sideNavMin');

           $('#navFooter').addClass('navFooterMin');
           $('#navFooter').removeClass('navFooterCollapsed');
           $('#navLogo').addClass('sprite-kownloon_single');
           $('#navLogo').removeClass('sprite-kowloon-logo');

           collapsed = false;
       }

   });


});

/*function dropdown(){
    $('#order_by').val();
    $('.wrapper-dropdown ul').addClass('hidden');
    $('.wrapper-dropdown div').val($(this).val());
}*/
