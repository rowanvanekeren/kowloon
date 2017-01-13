@extends('layouts.layout')


@section('content')
    <div class="main container-fluid " ng-app="app">

        <div class="col-md-8 col-md-offset-2 search_container ">


            <div class="row">
                <form method="POST" action="{{url(App::getLocale().'/update_article')}}" id="create_form" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="col-md-12 title">
                        <div class="col-md-6"><h1>NL</h1></div>
                        <div class="col-md-6"><h1>EN</h1></div>
                    </div>
                    <div class="col-md-12 shared_inputs">
                        <div class="create_inputs">
                            <label for="dd_category">categorie</label>
                            <select name="dd_category" id="dd_category">

                                @if(isset($categories))
                                    @foreach($categories as $category)
                                        @if($category->id == $articles->translation[0]->category_id)
                                            <option selected
                                                    value="{{$category->id}}">{{$category->translation[0]->type}}</option>
                                        @else
                                            <option value="{{$category->id}}">{{$category->translation[0]->type}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="create_inputs">
                            <label for="dd_collection">collectie</label>
                            <select name="dd_collection" id="dd_collection">
                                @if(isset($collections))
                                    @foreach($collections as $collection)
                                        @if($collection->id == $articles->translation[0]->collection_id)
                                            <option value="{{$collection->id}}"
                                                    selected>{{$collection->translation[0]->type}}</option>
                                        @else
                                            <option value="{{$collection->id}}">{{$collection->translation[0]->type}}</option>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="create_colors">

                            @foreach($articles->color as $color)
                            <div class="color_section">
                                <div class="create_inputs">
                                    <label for="color">color</label>
                                    <input type="text" name="color[]" id="color" value="{{$color->hex}}" required/>
                                </div>
                                <div class="create_inputs">

                                    <input type="hidden" name="color_id[]" id="color" value="{{$color->id}}" required/>
                                </div>
                            </div>
                            @endforeach()
                        </div>

                    </div>
                    <div class="col-md-6 create_nl">
                        @foreach($articles->alltranslation as $article)
                            @if($article->locale == 'nl')
                        <div class="create_main">
                            <div class="create_inputs">
                                <label for="title_nl">titel</label>
                                <input type="text" name="title_nl" id="title_nl" value="{{$article->title}}" required/>
                            </div>
                            <div class="create_inputs">
                                <label for="description_nl">beschrijving</label>
                                <input type="text" name="description_nl" id="description_nl"
                                       value="{{$article->description}}" required />
                            </div>
                            <div class="create_inputs">
                                <label for="tags_nl">tags</label>
                                <input type="text" name="tags_nl" id="tags_nl" value="{{$article->tags}}" required/>
                            </div>
                            <div class="create_inputs">
                                <label for="price_nl">prijs</label>
                                <input type="number" name="price_nl" id="price_nl" value="{{$article->price}}" required/>
                            </div>
                            <div class="create_inputs">
                                <input type="hidden" name="art_id_nl" id="art_id_nl" value="{{$article->id}}" required/>
                            </div>
                            @endif
                        @endforeach
                        </div>
                        <div class="create_specifications_nl">

                            <div class="spec_section_nl">
                                @foreach($specifications->alltranslation as $spec)
                                    @if($spec->locale == 'nl')
                                        <div class="create_inputs">
                                            <label for="dimension_spec_nl">dimensies</label>
                                            <input type="text" name="dimension_spec_nl[]" id="dimension_spec_nl"
                                                   value="{{$spec->dimension}}" required/>
                                        </div>
                                        <div class="create_inputs">
                                            <label for="descr_spec_nl">beschrijving</label>
                                            <input type="text" name="descr_spec_nl[]" id="descr_spec_nl"
                                                   value="{{$spec->description}}" required/>
                                        </div>
                                        <div class="create_inputs">
                                            <label for="size_spec_nl">grootte</label>
                                            <input type="text" name="size_spec_nl[]" id="size_spec_nl"
                                                   value="{{$spec->size}}" required/>
                                        </div>
                                        <div class="create_inputs">

                                            <input type="hidden" name="id_spec_nl[]" id="id_spec_nl"
                                                   value="{{$spec->id}}" required/>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>
                        {{--                  <div class="create_colors_nl">
                                              <button type="button" id="create_color_nl" onclick="e.preventDefault()">nog een kleur
                                                  toevoegen
                                              </button>

                                              <div class="color_section_nl">
                                                  <div class="create_inputs">
                                                      <label for="color_nl">color</label>
                                                      <input type="text" name="color_nl[]" id="color_nl" placeholder="geef color"/>
                                                  </div>
                                              </div>
                                          </div>--}}

                    </div>
                    <div class="col-md-6 create_en">
                        @foreach($articles->alltranslation as $article)
                            @if($article->locale == 'en')
                        <div class="create_main">
                            <div class="create_inputs">
                                <label for="title_en">titel</label>
                                <input type="text" name="title_en" id="title_en" value="{{$article->title}}" required/>
                            </div>
                            <div class="create_inputs">
                                <label for="description_en">beschrijving</label>
                                <input type="text" name="description_en" id="description_en"
                                       value="{{$article->description}}" required/>
                            </div>
                            <div class="create_inputs">
                                <label for="tags_en">tags</label>
                                <input type="text" name="tags_en" id="tags_en" value="{{$article->tags}}" required/>
                            </div>
                            <div class="create_inputs">
                                <label for="price_en">prijs</label>
                                <input type="number" name="price_en" id="price_en" value="{{$article->price}}" required/>
                            </div>
                            <div class="create_inputs">

                                <input type="hidden" name="art_id_en" id="art_id_en" value="{{$article->id}}" required/>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <div class="create_specifications_en">
                            <div class="spec_section_en">
                                @foreach($specifications->alltranslation as $spec)
                                    @if($spec->locale == 'en')
                                        <div class="create_inputs">
                                            <label for="dimension_spec_en">dimensies</label>
                                            <input type="text" name="dimension_spec_en[]" id="dimension_spec_en"
                                                   value="{{$spec->dimension}}" required/>
                                        </div>
                                        <div class="create_inputs">
                                            <label for="descr_spec_en">beschrijving</label>
                                            <input type="text" name="descr_spec_en[]" id="descr_spec_en"
                                                   value="{{$spec->description}}" required/>
                                        </div>
                                        <div class="create_inputs">
                                            <label for="size_spec_en">grootte</label>
                                            <input type="text" name="size_spec_en[]" id="size_spec_en"
                                                   value="{{$spec->size}}" required/>
                                        </div>
                                        <div class="create_inputs">
                                            <input type="hidden" name="id_spec_en[]" id="id_spec_en"
                                                   value="{{$spec->id}}" required/>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                        </div>

                    </div>
                    <div class="col-md-12">
                        @foreach($articles->image as $images)

                            <div class="create_inputs">
                                <label for="image1">main image</label>
                                <input type="file" name="image[]" id="image1" required>
                                @foreach($images->alltranslation as $image)
                                    @if($image->locale == 'nl')
                                        <div class="col-md-6">
                                            <input type="text" name="img_descr_nl[]" id="img1_descr_nl"
                                                   value="{{$image->description}}" required>

                                        </div>
                                        <div class="col-md-6">
                                            <input type="hidden" name="img_id_nl[]" id="img_id_nl"
                                                   value="{{$image->id}}" required>
                                        </div>
                                    @elseif($image->locale == 'en')
                                        <div class="col-md-6">
                                            <input type="text" name="img_descr_en[]" id="img1_descr_en"
                                                   value="{{$image->description}}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="hidden" name="img_id_en[]" id="img_id_en"
                                                   value="{{$image->id}}" required>
                                        </div>

                                    @endif
                                @endforeach
                            </div>
                        @endforeach

                    </div>
                    <div class="col-md-12">
                    <input type="hidden" name="main_article" value="{{$main_article}}" required/>

                    </div>
                    <div class="col-md-12">
                        <input type="submit" id="submit" value="verzenden" >
                    </div>
                </form>
            </div>

        </div>


    </div>

@endsection