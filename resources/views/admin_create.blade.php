@extends('layouts.layout')


@section('content')
    <div class="main container-fluid " ng-app="app">

        <div class="col-md-8 col-md-offset-2 search_container ">


            <div class="row">
                <form method="POST" action="./create_article" id="create_form" enctype="multipart/form-data">
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
                                        <option value="{{$category->id}}">{{$category->translation[0]->type}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="create_inputs">
                            <label for="dd_collection">collectie</label>
                            <select name="dd_collection" id="dd_collection">
                                @if(isset($collections))
                                    @foreach($collections as $collection)
                                        <option value="{{$collection->id}}">{{$collection->translation[0]->type}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <div class="create_colors">
                            <button type="button" id="create_color">nog een kleur
                                toevoegen
                            </button>

                            <div class="color_section">
                                <div class="create_inputs">
                                    <label for="color">color</label>
                                    <input type="text" name="color[]" id="color" placeholder="give color"/>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6 create_nl">

                        <div class="create_main">
                            <div class="create_inputs">
                                <label for="title_nl">titel</label>
                                <input type="text" name="title_nl" id="title_nl" placeholder="geef titel"/>
                            </div>
                            <div class="create_inputs">
                                <label for="description_nl">beschrijving</label>
                                <input type="text" name="description_nl" id="description_nl"
                                       placeholder="geef beschrijving"/>
                            </div>
                            <div class="create_inputs">
                                <label for="tags_nl">tags</label>
                                <input type="text" name="tags_nl" id="tags_nl" placeholder="geef tags"/>
                            </div>
                            <div class="create_inputs">
                                <label for="price_nl">prijs</label>
                                <input type="number" name="price_nl" id="price_nl" placeholder="geef prijs"/>
                            </div>

                        </div>
                        <div class="create_specifications_nl">
                            <button type="button" id="create_spec_nl">nog een specificatie
                                toevoegen
                            </button>
                            <div class="spec_section_nl">
                                <div class="create_inputs">
                                    <label for="dimension_spec_nl">dimensies</label>
                                    <input type="text" name="dimension_spec_nl[]" id="dimension_spec_nl"
                                           placeholder="geef dimnesie"/>
                                </div>
                                <div class="create_inputs">
                                    <label for="descr_spec_nl">beschrijving</label>
                                    <input type="text" name="descr_spec_nl[]" id="descr_spec_nl"
                                           placeholder="geef beschrijving"/>
                                </div>
                                <div class="create_inputs">
                                    <label for="size_spec_nl">grootte</label>
                                    <input type="text" name="size_spec_nl[]" id="size_spec_nl"
                                           placeholder="geef grootte (s, m ,l)"/>
                                </div>
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

                        <div class="create_main">
                            <div class="create_inputs">
                                <label for="title_en">titel</label>
                                <input type="text" name="title_en" id="title_en" placeholder="geef titel"/>
                            </div>
                            <div class="create_inputs">
                                <label for="description_en">beschrijving</label>
                                <input type="text" name="description_en" id="description_en"
                                       placeholder="geef beschrijving"/>
                            </div>
                            <div class="create_inputs">
                                <label for="tags_en">tags</label>
                                <input type="text" name="tags_en" id="tags_en" placeholder="geef tags"/>
                            </div>
                            <div class="create_inputs">
                                <label for="price_en">prijs</label>
                                <input type="number" name="price_en" id="price_en" placeholder="geef prijs"/>
                            </div>
                        </div>
                        <div class="create_specifications_en">
                            <button type="button" id="create_spec_en">nog een specificatie
                                toevoegen
                            </button>
                            <div class="spec_section_en">
                                <div class="create_inputs">
                                    <label for="dimension_spec_en">dimensies</label>
                                    <input type="text" name="dimension_spec_en[]" id="dimension_spec_en"
                                           placeholder="geef dimnesie"/>
                                </div>
                                <div class="create_inputs">
                                    <label for="descr_spec_en">beschrijving</label>
                                    <input type="text" name="descr_spec_en[]" id="descr_spec_en"
                                           placeholder="geef beschrijving"/>
                                </div>
                                <div class="create_inputs">
                                    <label for="size_spec_en">grootte</label>
                                    <input type="text" name="size_spec_en[]" id="size_spec_en"
                                           placeholder="geef grootte (s, m ,l)"/>
                                </div>
                            </div>

                        </div>
                        {{--                        <div class="create_colors_en">
                                                    <button type="button" id="create_color_en" onclick="e.preventDefault()">nog een kleur
                                                        toevoegen
                                                    </button>

                                                    <div class="color_section_en">
                                                        <div class="create_inputs">
                                                            <label for="color_en">color</label>
                                                            <input type="text" name="color_en[]" id="color_en" placeholder="give color"/>
                                                        </div>
                                                    </div>
                                                </div>--}}
                    </div>
                    <div class="col-md-12">
                        <div class="create_inputs">
                            <label for="image1">main image</label>
                            <input type="file" name="image[]" id="image1">

                            <div class="col-md-6">
                                <input type="text" name="img_descr_nl[]" id="img1_descr_nl"
                                       placeholder="beschrijving foto">

                            </div>
                            <div class="col-md-6">
                                <input type="text" name="img_descr_en[]" id="img1_descr_en"
                                       placeholder="description image">
                            </div>
                        </div>
                        <div class="create_inputs">
                            <label for="image2">image 2</label>
                            <input type="file" name="image[]" id="image2">

                            <div class="col-md-6">
                                <input type="text" name="img_descr_nl[]" id="img2_descr_nl"
                                       placeholder="beschrijving foto">

                            </div>
                            <div class="col-md-6">
                                <input type="text" name="img_descr_en[]" id="img2_descr_en"
                                       placeholder="description image">
                            </div>
                        </div>
                        <div class="create_inputs">
                            <label for="image3">image 3</label>
                            <input type="file" name="image[]" id="image3">

                            <div class="col-md-6">
                                <input type="text" name="img_descr_nl[]" id="img3_descr_nl"
                                       placeholder="beschrijving foto">

                            </div>
                            <div class="col-md-6">
                                <input type="text" name="img_descr_en[]" id="img3_descr_en"
                                       placeholder="description image">
                            </div>
                        </div>
                        <div class="create_inputs">
                            <label for="image4">image 4</label>
                            <input type="file" name="image[]" id="image4">

                            <div class="col-md-6">
                                <input type="text" name="img_descr_nl[]" id="img4_descr_nl"
                                       placeholder="beschrijving foto">

                            </div>
                            <div class="col-md-6">
                                <input type="text" name="img_descr_en[]" id="img4_descr_en"
                                       placeholder="description image">
                            </div>
                        </div>

                    </div>
                    <div class="col-md-12">


                    </div>
                    <div class="col-md-12">
                        <input type="submit" id="submit" value="verzenden">
                    </div>
                </form>
            </div>

        </div>


    </div>

@endsection