@extends('layouts.layout')


@section('content')
    <div class="main container-fluid " ng-app="app">

            <div class="col-md-8 col-md-offset-2 search_container ">
                <div>


                    @include('layouts.search_filter')




                        @if(isset($articles) && $articles != '')
                            @foreach($articles as $article)
                            <div class="row white_box">
                                <a href="{{url(App::getLocale().'/detail/'.$article->id)}}">
                                <h3>{{$article->translation[0]->title}}</h3>
                                <p>{{$article->translation[0]->description}}</p>
                                </a>
                            </div>
                            @endforeach
                        @endif



                    <div class="row"><hr></div>
                </div>
            </div>


    </div>

@endsection