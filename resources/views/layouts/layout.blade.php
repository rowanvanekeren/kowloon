<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   {{-- <link rel="stylesheet" type="text/css" href="../css/test.css">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/jquery-ui.css') }}">
    <title>Laravel</title>

</head>
<body>

<div id='sideNav' class="sideNavMin">
    <div class="navFixed">

    <div class="navBurger">
        <div class="inlinetest">
            <div class="icon"> <i class="sprite sprite-burger"></i></div>
        </div>
    </div>
    <div class="help">
        <div class="help-section">
            <a href="{{url(App::getLocale(). '/help')}}">
            <div class="icon"><i class="sprite sprite-search"></i></div>
            <div class="icon-text-help hidden">@lang('page_content.help')</div>
            </a>
        </div>
        <div class="help-section">
            <a href="{{url(App::getLocale(). '/search')}}">
            <div class="icon"><i class="sprite sprite-faq"></i></div>
            <div class="icon-text-help hidden">@lang('page_content.search')</div>
            </a>
        </div>
    </div>
    <div class="navSeperator">

    </div>

        <div class="animals">
        <div class="dog">
            <a  href="{{url(App::getLocale(). '/dog')}}" class="{{ ($view_name == 'dog' ? 'active' : '') }}">
            <div class="icon"><i class="sprite sprite-dog_white"></i></div>
            <div class="icon-text-animal hidden">{{$categories[0]->translation[0]->type}}</div>
            </a>
        </div>
        <div class="cat">
            <a href="{{url(App::getLocale(). '/cat')}}" class="{{ ($view_name == 'cat' ? 'active' : '') }}">
            <div class="icon"><i class="sprite sprite-cat_white"></i></div>
            <div class="icon-text-animal hidden">{{$categories[1]->translation[0]->type}}</div>
            </a>
        </div>
        <div class="fish">
            <a href="{{url(App::getLocale(). '/fish')}}" class="{{ ($view_name == 'fish' ? 'active' : '') }}">
            <div class="icon"><i class="sprite sprite-fish_white"></i></div>
            <div class="icon-text-animal hidden">{{$categories[2]->translation[0]->type}}</div>
            </a>
        </div>
        <div class="bird">
            <a href="{{url(App::getLocale(). '/bird')}}" class="{{ ($view_name == 'bird' ? 'active' : '') }}">
            <div class="icon"><i class="sprite sprite-bird_white"></i></div>
            <div class="icon-text-animal hidden">{{$categories[3]->translation[0]->type}}</div>
            </a>
        </div>
            <div class="hamster">
                <a href="{{url(App::getLocale(). '/hamster')}}" class="{{ ($view_name == 'hamster' ? 'active' : '') }}">
                <div class="icon"><i class="sprite sprite-hamster_white"></i></div>
                <div class="icon-text-animal hidden">{{$categories[4]->translation[0]->type}}</div>
                </a>
            </div>

        </div>
        <div class="navSeperator">

        </div>
        <div>
            <a href="{{ url('nl/' . $view_name) }}"><img class="locale_flag" src="{{asset('images/icons/nl.png')}}"> </a>
        </div>
        <div>
            <a href="{{ url('en/' . $view_name) }}"><img class="locale_flag" src="{{asset('images/icons/en.png')}}"></a>
        </div>

    <div id="navFooter" class="navFooterMin">
        <i id="navLogo" class="sprite sprite-kownloon_single"></i>
    </div>
    </div>

</div>



@yield('content')



<script src="{{ asset('/js/jquery-3.1.1.min.js') }}"></script>
<script src="{{ asset('/js/angular.min.js') }}"></script>
<script src="{{ asset('/js/main.js') }}"></script>
{{--<script src="../js/jquery-3.1.1.min.js"></script>
<script src="../js/angular.min.js"></script>
<script src="../js/main.js"></script>--}}
</body>
</html>
