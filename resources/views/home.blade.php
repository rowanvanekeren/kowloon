@extends('layouts.layout')


@section('content')

    <h1> @lang('page_title.home')</h1>

    @if (isset($errors) && count($errors) > 0)
        <div class="errors">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @lang('faq.faq')
@endsection