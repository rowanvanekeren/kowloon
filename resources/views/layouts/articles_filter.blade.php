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

<form method="post" action="./{{ $view_name }}" id="filterForm"
      onchange="document.getElementById('filterForm').submit()">
    {{ csrf_field() }}

    <div class="row filter_collapse">
        <p>filter <span>&#9660;</span></p>

        <div class="filter_collapse_content">
            <div class="col-md-12">
                <h3>@lang('filter.collection')</h3>
                @foreach($collections as $collection)


                    <input type="checkbox" id="{{$collection->translation[0]->type}}" value="1"
                           name="chkbx[{{$collection->id}}]"
                           @if (old('chkbx.'.$collection->id)  == "1") checked @endif />
                    <label for="{{$collection->translation[0]->type}}">{{$collection->translation[0]->type}}</label>
                @endforeach
            </div>
            <div class="col-md-12 price_section">
                <h3>@lang('filter.price_range')</h3>
                <ul>
                    <li>
                        <div class="price-range">
                            <div id="slider-range"></div>
                        </div>
                    </li>
                    <li><input type="number" name="minprice" step="0.01" id="minPrice"
                               value="{{ old('minprice', 0) }}"/></li>
                    <li> -</li>
                    <li><input type="number" name="maxprice" step="0.01" id="maxPrice"
                               value="{{ old('maxprice', 800) }}"/></li>
                </ul>
                <input type="hidden" id="filter_view" name="view_name" value="{{ $view_name }}"/>
                <input type="hidden" name="category_id" id="category_id"
                       value="@if(isset($articles[0]->translation[0]->category_id)){{ $articles[0]->translation[0]->category_id}} @endif"/>
                <input type="hidden" name="order_by" id="order_by"
                       value="@if( old('order_by') != null){{old('order_by')}}@else{{'default'}}@endif"/>
            </div>
        </div>
    </div>

    <div class="row">
        <hr/>

    </div>

    <div class="row dd_section">
        <div class="wrapper-dropdown">
            <div class="@if( old('order_by') != null){{'has_old'}}@else{{'default'}}@endif">Select Value</div>
            <ul class="dropdown hidden">
                <li id="price_up">Price low to high</li>
                <li id="price_down">Price high to low</li>
                <li id="latest">Latest</li>
                <li id="oldest">Oldest</li>
            </ul>
        </div>
    </div>
</form>

<div class="row">
    @if (isset($errors) && count($errors) > 0)
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
