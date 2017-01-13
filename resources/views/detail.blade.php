@extends('layouts.layout')


@section('content')
    <div class="main container-fluid bg-color-1" ng-app="app">


        <div class="col-md-8 col-md-offset-2">

            <div class="row"> kowloon logo</div>
            <div class="row">
                <div class="col-md-6 no-padding">
                    {{-- {{dd($article)}}--}}
                    @foreach($article->image as $key => $image)
                        @if($key <= 3)
                            @if($key == 0)
                                <div class="col-md-12 det_main_img ">
                                    <div class="" style="background-image: url({{asset('images/article_pictures/'.$image->translation[0]->image)}})"> </div>
                                </div>
                            @else
                                <div class="col-md-4 det_small_img ">
                                    <div style="background-image: url({{asset('images/article_pictures/'.$image->translation[0]->image)}})"></div>
                                    <p>{{$image->translation[0]->description}}</p>
                                </div>
                            @endif
                        @endif
                    @endforeach
                </div>
                <div class="col-md-6">
                    <div class="col-md-12 breadcrumbs">
                        <div class="">
                            <div class="crumb_category">
                                <i id="KLogo" class="sprite sprite-kownloon_single">
                                </i><span class="pricetag">{{ $article_category->translation[0]->type }}</span>
                            </div>

                            <div class="crumb_collection"><span
                                        class="pricetag">{{$collection->translation[0]->type}}</span>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12"><h1>{{$article->translation[0]->title}}</h1>

                        <h3>{{$article->translation[0]->price}}</h3>
                        <ul class="colors">
                            @foreach($article->color as $color)
                                <li class="color" style="background-color: #{{$color->hex}}">
                                </li>
                            @endforeach
                        </ul>
                        <h4>Description</h4>

                        <p>{{$article->translation[0]->description}}</p>
                    </div>
                    <div class="col-md-12"></div>
                </div>

            </div>
            <div class="row detail_spec_wrapper">
                <div class="col-md-12 inl-block">
                    <h2>Specifications</h2>
                    <h4>Dimensions</h4>
                    <ul class="inl_block">

                        @foreach($specifications->translation as $spec)
                            <li><strong>{{$spec->size}}</strong> - {{$spec->dimension}}</li>
                        @endforeach

                    </ul>

                </div>
                <div class="col-md-12 ">
                    <h4>Title</h4>
                    <ul class="inl_block">

                        @foreach($specifications->translation as $spec)
                            <li><strong>{{$spec->size}}</strong> - {{$spec->description}}</li>
                        @endforeach

                    </ul>

                </div>

            </div>
            <div class="row related">
                <ul>
                    @foreach($related as $rel)
                   <li><a href="#"><div style="background-image: url({{asset('images/article_pictures/'.$rel->image[0]->translation[0]->image)}})">
                           <div class="art_hover_overlay"
                                style="visibility:hidden; background-image: url( {{asset('images/article_pictures/')}}@lang('page_content.art_hover_img')"> </div>
                       </div></a></li>
                    @endforeach
                </ul>
            </div>

            <div class="row">
                @foreach($article->faq as $faq)
                <div class="col-md-12">
                    <h2>{{$faq->translation[0]->question}}</h2>
                    <div class="faq_answer_collapse"><p>{{$faq->translation[0]->answer}}</p></div>

                </div>
                @endforeach
            </div>
            <div class="row">dfgsdfg</div>
            <div class="row">dfgsdfg</div>
            <div class="row">dfgsdfg</div>


        </div>
    </div>
@endsection