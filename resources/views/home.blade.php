@extends('layouts.layout')


@section('content')
    <div class="main container-fluid bg-color-1" ng-app="app">
        @if (Auth::guest())
            <div class="adminArea">
            <ul>
                <li><a href="{{ url(App::getLocale() . '/login') }}">login</a></li>
            </ul>
            </div>
        @else
            <div class="adminArea">
                <ul>
                    <li><a href="{{ url(App::getLocale() . '/logout') }}">logout</a></li>
                    <li><a href="{{ url(App::getLocale() . '/create_article/'  ) }}">create new article</a></li>
                    <li><a href="{{ url(App::getLocale() . '/create_faq') }}">new faq</a></li>
             {{--       <li><a href="{{ url(App::getLocale() . '/create_faq') }}"></a></li>
                    <li><a href="{{ url(App::getLocale() . '/create_faq') }}">logout</a></li>--}}
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-md-12 page_banner"
                 style="background-image: url({{asset('images/banners/banner_dog1.jpg')}})">

            </div>
        </div>
        <div class="col-md-8 col-md-offset-2">
            <div class="row hot-items">
                <ul>
                    <li><a href=""><i class="sprite-big sprite-bird-big"></i>
                    <h3 class="hot-items-h3">{{$categories[3]->translation[0]->type}}</h3></a>
                    </li>
                    <li><div class="hot-items-devider"></div></li>
                    <li><a href="{{url(App::getLocale(). '/cat')}}"><i class="sprite-big sprite-cat-big"></i>
                        <h3 class="hot-items-h3">{{$categories[1]->translation[0]->type}}</h3></a></li>
                    <li><div class="hot-items-devider"></div></li>
                    <li><a href="{{url(App::getLocale(). '/dog')}}"><i class="sprite-big sprite-dog-big"></i>    <h3 class="hot-items-h3">{{$categories[0]->translation[0]->type}}</h3> </a></li>
                    <li><div class="hot-items-devider"></div></li>
                    <li><a href="{{url(App::getLocale(). '/fish')}}"><i class="sprite-big sprite-fish-big"></i>    <h3 class="hot-items-h3">{{$categories[2]->translation[0]->type}}</h3> </a></li>
                    <li><div class="hot-items-devider"></div></li>
                    <li><a href="{{url(App::getLocale(). '/hamster')}}"><i class="sprite-big sprite-hamster-big"></i>    <h3 class="hot-items-h3">{{$categories[4]->translation[0]->type}}</h3> </a></li>
                    <li><div class="hot-items-devider"></div></li>
                    <li><a href=""><i class="sprite-big sprite-other-big"></i>    <h3 class="hot-items-h3">{{$categories[5]->translation[0]->type}}</h3> </a></li>
                </ul>
            </div>
            <h1>Hot Items</h1>

{{--            <div class="row hotitems">
                <ul>
                    @foreach($articles as $article)
                        <li><a href="#">
                                <div style="background-image: url({{asset('images/article_pictures/'.$article->image[0]->translation[0]->image)}})">
                                    <div class="art_hover_overlay"
                                         style="visibility:hidden; background-image: url( {{asset('images/article_pictures/')}}@lang('page_content.art_hover_img')"></div>
                                </div>
                                <p class="hot-items-descr">sdfsdf</p><p class="hot-items-price">sdfsdf</p>
                            </a></li>
                    @endforeach
                </ul>
            </div>--}}
            <div class="row ">

                    @foreach($articles as $article)
                        <div class="small_article hot-itmes-float">
                                <a href="{{url(App::getLocale().'/detail/'. $article->id)}}">
                                    <div class="art_img"
                                         style="background-image: url( {{asset('images/article_pictures/'.$article->image[0]->translation[0]->image)}} )">
                                        <div class="art_hover_overlay"
                                             style="background-image: url( {{asset('images/article_pictures/')}}@lang('page_content.art_hover_img')"> </div>
                                    </div>
                                    <div class="art_content">
                                        <p>{{$article->translation[0]->title}}</p>
                                        <p>&euro;{{$article->translation[0]->price}}</p>
                                    </div>
                                </a>
                            </div>
                    @endforeach

            </div>
            <div class="row">
                <div class="paginate">{{ $articles->links() }}</div>
            </div>
            @include('layouts.newsletter')
            <div class="row">sdfsdfsdfsdfsfd</div>
            <div class="row">sdfsdfsdfsdfsfd</div>
            <div class="row">sdfsdfsdfsdfsfd</div>
            <div class="row">sdfsdfsdfsdfsfd</div>
            <div class="row">sdfsdfsdfsdfsfd</div>
            <div class="row">sdfsdfsdfsdfsfd</div>
        </div>
    </div>
@endsection