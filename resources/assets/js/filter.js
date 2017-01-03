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