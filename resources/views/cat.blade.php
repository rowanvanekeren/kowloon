@extends('layouts.layout')


@section('content')

    <h1> @lang('page_title.cat')</h1>
    <div>
        @include('layouts.articles_filter')
    </div>
    @if (isset($errors) && count($errors) > 0)
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if(isset($articles))
    @foreach($articles as $article)
        {{$article->translation[0]->title}}
    @endforeach
    <h1>{{  var_dump($errors) }}</h1>

    <div>
        <h1>{{ $articles->links() }}</h1>
    </div>
    @endif

    @lang('faq.faq')
@endsection