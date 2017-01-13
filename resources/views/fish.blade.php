@extends('layouts.layout')


@section('content')
    <div class="main container-fluid bg-color-1" ng-app="app">
        <div class="row">
            <div class="col-md-12 page_banner" style="background-image: url({{asset('images/banners/banner_dog1.jpg')}})">

            </div>
        </div>

        <div class="col-md-8 col-md-offset-2">
            <div class="row breadcrumbs">
                <div class="">
                    <div class="crumb_category">
                        <i id="KLogo" class="sprite sprite-kownloon_single">
                        </i><span class="pricetag">{{ $categories[3]->translation[0]->type }}</span>
                    </div>
                    @foreach($collections as $collection)
                        @if(old('chkbx.'.$collection->id)  == "1")
                            <div class="crumb_collection"><span
                                        class="pricetag">{{$collection->translation[0]->type}}</span>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <div class="row">
                <h1> @lang('page_title.'. $view_name)</h1>
            </div>

            @include('layouts.articles_filter')

            <div class="row">

                @foreach($articles as $key => $article)
                    @if($key == 0)
                        <div class="col-md-6 pull-right head_article">
                            <div class="art_img"
                                 style="background-image: url( {{asset('images/article_pictures/standard.jpg')}} )">

                            </div>
                            <div class="art_content">
                                <h4>{{$article->translation[0]->title}}</h4>
                                <p> {{ $article->translation[0]->description }}</p>
                            </div>
                            <div class="art_footer"><a href="./detail/{{$article->id}}"> @lang('page_content.head_article_footer')</a></div>

                        </div>
                    @else
                        <div class="col-md-3 small_article">
                            <a href="./details/{{$article->id}}">
                                <div class="art_img"
                                     style="background-image: url( {{asset('images/article_pictures/standard_small.jpg')}} )">
                                    <div class="art_hover_overlay"
                                         style="background-image: url( {{asset('images/article_pictures/')}}@lang('page_content.art_hover_img')"> </div>
                                </div>
                                <div class="art_content">
                                    <p>{{$article->translation[0]->title}}</p>
                                    <p>&euro;{{$article->translation[0]->price}}</p>
                                </div>
                            </a>
                        </div>
                    @endif

                @endforeach

            </div>
            <div class="row">
                <div class="paginate">{{ $articles->links() }}</div>
            </div>


        </div>
    </div>
@endsection