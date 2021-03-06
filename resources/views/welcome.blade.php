@extends('layouts.layout')


@section('content')

    <h1> @lang('dog.title')</h1>
    <div>
        @include('layouts.articles_filter')
    </div>
    @foreach($articles as $article)
        {{$article->translation[0]->title}}
    @endforeach

    <div>
        <h1>{{ $articles->links() }}</h1>
    </div>
    @lang('faq.faq')
@endsection