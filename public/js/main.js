/**
 * Created by Rowan on 27-12-2016.
 */

$( document ).ready(function() {
    var collapsed = false;
/*   var activeClass = localStorage.getItem('active');
    $('.' + activeClass).addClass('active');

    $('.animals a').click(function(){
        $('.animals a').removeClass('active');
        $(this).addClass('active');
        localStorage.setItem('active', $(this).attr('class'));
    });*/
   /* $('input').on('click',(function(){
        document.getElementById('filter').submit();
    }));*/
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

var app = angular.module("app",[]).controller("filterController", function ($scope, $http) {
console.log('filtercontroller initialised');

    $scope.filterInputs = function(){
        var viewNameID = "#filter_view";
        var minPriceID = "#minPrice";
        var maxPriceID = "#maxPrice";

        var selected = [];
        $('.filterInputs input:checked').each(function() {
            selected.push($(this).attr('value'));
        });
        var viewName = $(viewNameID).val();
        var minPrice = $(minPriceID).val();
        var maxPrice = $(maxPriceID).val();


        var req = {
            method: 'POST',
            url: './filterArticles',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                /* 'Content-Type': 'application/x-www-form-urlencoded'*/
            },
            data: {
                checked: selected,
                view: viewName,
                minPrice: minPrice,
                maxPrice: maxPrice
            }
        };

        $http(req).then(function(data){

                console.log(data);
            }

        );
    }
});
//# sourceMappingURL=main.js.map
