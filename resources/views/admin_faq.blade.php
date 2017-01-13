@extends('layouts.layout')


@section('content')

    <div class="main container-fluid " ng-app="app">

        <div class="col-md-8 col-md-offset-2 search_container ">
            <div class="col-md-12">
                    @if(!isset($faqs))
                    <form method="post" action="{{url(App::getLocale() . '/create_faq')}}">
                        {{ csrf_field() }}
                        @if(isset($article))
                            <div class="col-md-12"><h1>Create FAQ for {{$article->translation[0]->title}} </h1></div>
                        @else
                            <div class="col-md-12"><h1>General Faq</h1></div>
                        @endif
                        <div class="col-md-12">
                        <div class="col-md-6" id="faq_nl">
                            <h1>nl</h1>
                            <input type="text" name="question_nl">
                            <textarea name="answer_nl"></textarea>

                        </div>
                        <div class="col-md-6" id="faq_en">
                            <h1>en</h1>
                            <input type="text" name="question_en">
                                  <textarea name="answer_en"> </textarea>
                        </div>
                         @if(isset($article))
                        <input type="hidden" name="faq_art_id" value={{$article->id}} />
                        @endif
                        </div>
                        <div class="col-md-12">
                            <input type="submit" value="create">
                        </div>
                    </form>
                @endif







            </div>
            <div class="col-md-12">
                @if(isset($faqs))
                    <form method="post" action="{{url(App::getLocale() . '/update_faq')}}">
                        {{ csrf_field() }}
                        @foreach($faqs as $faq)

                            <div class="col-md-6">
                                <h1>{{$faq->locale}}</h1>
                                <input type="text" name="question[]" value="{{$faq->question}}">

                                <textarea name="answer[]">{{$faq->answer}}</textarea>
                                <input type="hidden" name="faqtrans_id[]" value="{{$faq->id}}">
                            </div>

                        @endforeach
                        <input type="submit" value="update">
                    </form>
                @endif


            </div>
        </div>
    </div>

@endsection