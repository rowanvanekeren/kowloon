@extends('layouts.layout')


@section('content')

    <h1> @lang('page_title.dog')</h1>
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
    @foreach($articles as $article)
        {{$article->translation[0]->title}}
    @endforeach

<div>
  <h1>{{ $articles->links() }}</h1>
</div>
    @lang('faq.faq')
@endsection
