<div ng-controller="filterController" class="filterInputs">
{{--    <form  action="dog" id="filter">
        <label for="splashnfun">Splash 'n Fun</label>
        <input type="checkbox" name="splashnfun" id="splashnfun" ng-model="filterCheckbox.splashnfun" ng-click="filterInputs()"/>
        <label for="luxury">luxury</label>
        <input type="checkbox" name="luxury" id="luxury" ng-model="filterCheckbox.luxury" ng-click="filterInputs()"/>
        <label for="new">new</label>
        <input type="checkbox" name="new" id="new" ng-model="filterCheckbox.new" ng-click="filterInputs()"/>
        <label for="onsale">onsale</label>
        <input type="checkbox" name="onsale" id="onsale" ng-model="filterCheckbox.onsale" ng-click="filterInputs()"/>
        <label for="other">other</label>
        <input type="checkbox" name="other" id="other" value="other" ng-model="filterCheckbox.other" ng-click="filterInputs()"/>

        <input type="number" name="minprice" step="0.01" id="minprice" value="8"/>
        <input type="number" name="maxprice" step="0.01" id="maxprice" value="800"/>

    </form>--}}
    <form method="post" action="./{{ $view_name }}" id="filterForm" onchange="document.getElementById('filterForm').submit()">
        {{ csrf_field() }}

    @foreach($collections as $collection)

      {{--  <label for="{{$collection->translation[0]->type}}">{{$collection->translation[0]->type}}</label>
        <input type="checkbox" name="{{$collection->translation[0]->type}}"  id="{{$collection->translation[0]->type}}"
               value="{{$collection->translation[0]->id}}"  ng-click="filterInputs()"  />--}}
            <label for="{{$collection->translation[0]->type}}">{{$collection->translation[0]->type}}</label>
       <input type="checkbox" id="{{$collection->translation[0]->type}}" value="1" name="chkbx[{{$collection->id}}]" @if (old('chkbx.'.$collection->id)  == "1") checked @endif />


    @endforeach
        <input type="number" name="minprice" step="0.01" id="minPrice" value="8" />
        <input type="number" name="maxprice" step="0.01" id="maxPrice" value="800" />
        <input type="hidden" id="filter_view" name="view_name" value="{{ $view_name }}"/>
        <input type="hidden" name="category_id" id="category_id" value="@if(isset($articles[0]->translation[0]->category_id)){{ $articles[0]->translation[0]->category_id}} @endif"/>
    </form>

    @if(isset($custom_errors))
        <h1>{{$custom_errors }}</h1>
        @endif

</div>